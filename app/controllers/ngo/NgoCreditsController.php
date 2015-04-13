<?php

class AdminBlogsController extends AdminController {


    /**
     * Post Model
     * @var Post
     */

    /**
     * Inject the models.
     * @param Post $post
     */
    public function __construct()
    {
        parent::__construct();

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
        return View::make('site/ong/credits', compact('title'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postCreate()
	{
        // Declare the rules for the form validation
        $rules = array(
            'credits' => 'required|integer|min:0',
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes())
        {
            // Create a new blog post
            $user = Auth::user();

            // ### Payer
            // A resource representing a Payer that funds a payment
            // Use the List of `FundingInstrument` and the Payment Method
            // as 'credit_card'
            $payer = Paypalpayment::payer();
            $payer->setPaymentMethod("paypal");

            $item1 = Paypalpayment::item();
            $item1->setName('Credits Piece by Peace')
                ->setDescription('Credits for campaigns')
                ->setCurrency('EUR')
                ->setQuantity(Input::get("credits"))
                ->setTax(0.3)
                ->setPrice(7.50);




            $itemList = Paypalpayment::itemList();
            $itemList->setItems(array($item1,$item2));


            $details = Paypalpayment::details();
            $details->setShipping("1.2")
                ->setTax("1.3")
                //total of items prices
                ->setSubtotal("17.5");

            //Payment Amount
            $amount = Paypalpayment::amount();
            $amount->setCurrency("USD")
                // the total is $17.8 = (16 + 0.6) * 1 ( of quantity) + 1.2 ( of Shipping).
                ->setTotal("20")
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

            // ### Payment
            // A Payment Resource; create one using
            // the above types and intent as 'sale'

            $payment = Paypalpayment::payment();

            $payment->setIntent("sale")
                ->setPayer($payer)
                ->setTransactions(array($transaction));

            try {
                // ### Create Payment
                // Create a payment by posting to the APIService
                // using a valid ApiContext
                // The return object contains the status;
                $payment->create($this->_apiContext);
            } catch (\PPConnectionException $ex) {
                return  "Exception: " . $ex->getMessage() . PHP_EOL;
                exit(1);
            }

            // Was the blog post created?
            if($this->post->save())
            {
                // Redirect to the new blog post page
                return Redirect::to('admin/blogs/' . $this->post->id . '/edit')->with('success', Lang::get('admin/blogs/messages.create.success'));
            }

            // Redirect to the blog post create page
            return Redirect::to('admin/blogs/create')->with('error', Lang::get('admin/blogs/messages.create.error'));
        }

        // Form validation failed
        return Redirect::to('admin/blogs/create')->withInput()->withErrors($validator);
	}

    /**
     * Display the specified resource.
     *
     * @param $post
     * @return Response
     */
	public function getShow($post)
	{
        // redirect to the frontend
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