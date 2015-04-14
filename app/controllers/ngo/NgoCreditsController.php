<?php

class NgoCreditsController extends BaseController {


    private $_api_context;

    private $_ClientId='AQ10YGdwkquqM6DpBspIeagRqOOeGPh4Dz19832jqdbr55laVUJPxXu2BBH6M7Ay2zNbhS6L2m9GhFaj-etMEY';
    private $_ClientSecret='EKwZnR0aoVXcgl4SkZgaDZeE2tctC6E0na4fEQmmcuFhyZi1l3kaS5NXQXc_IChCIePUVfgiRTPOdIgr';

    public function __construct()
    {

        // setup PayPal api context
        $payConf = Config::get('paypal');
        $this->_api_context = Paypalpayment::apiContext($this->_ClientId, $this->_ClientSecret);
        $this->_api_context->setConfig(array(
            'mode' => 'sandbox',
            'http.ConnectionTimeOut' => 30,
            'log.LogEnabled' => true,
            'log.FileName' => __DIR__.'/../PayPal.log',
            'log.LogLevel' => 'FINE'
        ));
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
        // Title
        $title = Lang::get('ngo/credits/table.title');

        // Grab all the blog posts


        // Show the page
        return View::make('site/ngo/credits', compact('title'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postCreate()
    {
        $title = Lang::get('ngo/credits/table.title');
        // Declare the rules for the form validation
        $rules = array(
            'credits' => 'required|integer|min:0',
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes()) {
            // Create a new blog post
            $user = Auth::user();

            // ### Payer
            // A resource representing a Payer that funds a payment
            // Use the List of `FundingInstrument` and the Payment Method
            // as 'credit_card'
            $credits = Input::get("credits");
            $payer = Paypalpayment::payer();
            $payer->setPaymentMethod("paypal");

            $item1 = Paypalpayment::item();
            $item1->setName('Credits Piece by Peace')
                ->setDescription('Credits for campaigns')
                ->setCurrency('EUR')
                ->setQuantity($credits)
                ->setTax(0.3)
                ->setPrice(0.6);


            $itemList = Paypalpayment::itemList();
            $itemList->setItems(array($item1));


            $details = Paypalpayment::details();
            $details->setShipping("0")
                ->setTax($credits * 0.6 * 0.21)
                //total of items prices
                ->setSubtotal($credits * 0.6);

            //Payment Amount
            $amount = Paypalpayment::amount();
            $amount->setCurrency("EUR")
                // the total is $17.8 = (16 + 0.6) * 1 ( of quantity) + 1.2 ( of Shipping).
                ->setTotal(($credits * 0.6 * 0.21) + ($credits * 0.6))
                ->setDetails($details);

            // ### Transaction
            // A transaction defines the contract of a
            // payment - what is the payment for and who
            // is fulfilling it. Transaction is created with
            // a `Payee` and `Amount` types

            $transaction = Paypalpayment::transaction();
            $transaction->setAmount($amount)
                ->setItemList($itemList)
                ->setDescription("Payment description")
                ->setInvoiceNumber(uniqid());

            $baseUrl = public_path();
            $redirectUrls = Paypalpayment::redirectUrls();
            $redirectUrls->setReturnUrl(URL::to('ngo/executePayment'))
                ->setCancelUrl(URL::to('ngo/executePayment'));

            // ### Payment
            // A Payment Resource; create one using
            // the above types and intent as 'sale'

            $payment = Paypalpayment::payment();

            $payment->setIntent("sale")
                ->setPayer($payer)
                ->setRedirectUrls($redirectUrls)
                ->setTransactions(array($transaction));

            try {
                $payment->create($this->_api_context);
            } catch (\PayPal\Exception\PPConnectionException $ex) {
                if (\Config::get('app.debug')) {
                    echo "Exception: " . $ex->getMessage() . PHP_EOL;
                    $err_data = json_decode($ex->getData(), true);
                    exit;
                } else {
                    die('Some error occur, sorry for inconvenient');
                }
            }

            foreach($payment->getLinks() as $link) {
                if($link->getRel() == 'approval_url') {
                    $redirect_url = $link->getHref();
                    break;
                }
            }

            // add payment ID to session
            Session::put('paypal_payment_id', $payment->getId());

            if(isset($redirect_url)) {
                // redirect to paypal
                return Redirect::away($redirect_url);
            }

            return View::make('site/ngo/credits', compact('title'))->with('error', 'Unknown error occurred');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param $post
     * @return Response
     */
	public function getExecutePayment()
	{

        // Get the payment ID before session clear
        $payment_id = Session::get('paypal_payment_id');

        // clear the session payment ID
        Session::forget('paypal_payment_id');

        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
            return Redirect::route('original.route')
                ->with('error', 'Payment failed');
        }

        $payment = Paypalpayment::getById($payment_id, $this->_api_context);

        // PaymentExecution object includes information necessary
        // to execute a PayPal account payment.
        // The payer_id is added to the request query parameters
        // when the user is redirected from paypal back to your site
        $execution = Paypalpayment::paymentExecution;
        $execution->setPayerId(Input::get('PayerID'));

        //Execute the payment
        $result = $payment->execute($execution, $this->_api_context);

        //echo '<pre>';print_r($result);echo '</pre>';exit; // DEBUG RESULT, remove it later

        if ($result->getState() == 'approved') { // payment made
            return Redirect::route('original.route')
                ->with('success', 'Payment success');
        }
        return Redirect::route('original.route')
            ->with('error', 'Payment failed');
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param $post
     * @return Response
     */
	public function getEdit($post)
	{
        // Title
        $title = Lang::get('admin/blogs/title.blog_update');

        // Show the page
        return View::make('admin/blogs/create_edit', compact('post', 'title'));
	}

    /**
     * Update the specified resource in storage.
     *
     * @param $post
     * @return Response
     */
	public function postEdit($post)
	{

        // Declare the rules for the form validation
        $rules = array(
            'title'   => 'required|min:3',
            'content' => 'required|min:3'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            // Update the blog post data
            $post->title            = Input::get('title');
            $post->slug             = Str::slug(Input::get('title'));
            $post->content          = Input::get('content');
            $post->meta_title       = Input::get('meta-title');
            $post->meta_description = Input::get('meta-description');
            $post->meta_keywords    = Input::get('meta-keywords');

            // Was the blog post updated?
            if($post->save())
            {
                // Redirect to the new blog post page
                return Redirect::to('admin/blogs/' . $post->id . '/edit')->with('success', Lang::get('admin/blogs/messages.update.success'));
            }

            // Redirect to the blogs post management page
            return Redirect::to('admin/blogs/' . $post->id . '/edit')->with('error', Lang::get('admin/blogs/messages.update.error'));
        }

        // Form validation failed
        return Redirect::to('admin/blogs/' . $post->id . '/edit')->withInput()->withErrors($validator);
	}


    /**
     * Remove the specified resource from storage.
     *
     * @param $post
     * @return Response
     */
    public function getDelete($post)
    {
        // Title
        $title = Lang::get('admin/blogs/title.blog_delete');

        // Show the page
        return View::make('admin/blogs/delete', compact('post', 'title'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $post
     * @return Response
     */
    public function postDelete($post)
    {
        // Declare the rules for the form validation
        $rules = array(
            'id' => 'required|integer'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            $id = $post->id;
            $post->delete();

            // Was the blog post deleted?
            $post = Post::find($id);
            if(empty($post))
            {
                // Redirect to the blog posts management page
                return Redirect::to('admin/blogs')->with('success', Lang::get('admin/blogs/messages.delete.success'));
            }
        }
        // There was a problem deleting the blog post
        return Redirect::to('admin/blogs')->with('error', Lang::get('admin/blogs/messages.delete.error'));
    }

    /**
     * Show a list of all the blog posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getData()
    {
        $posts = Post::select(array('posts.id', 'posts.title', 'posts.id as comments', 'posts.created_at'));

        return Datatables::of($posts)

        ->edit_column('comments', '{{ DB::table(\'comments\')->where(\'post_id\', \'=\', $id)->count() }}')

        ->add_column('actions', '<a href="{{{ URL::to(\'admin/blogs/\' . $id . \'/edit\' ) }}}" class="btn btn-default btn-xs iframe" >{{{ Lang::get(\'button.edit\') }}}</a>
                <a href="{{{ URL::to(\'admin/blogs/\' . $id . \'/delete\' ) }}}" class="btn btn-xs btn-danger iframe">{{{ Lang::get(\'button.delete\') }}}</a>
            ')

        ->remove_column('id')

        ->make();
    }

}