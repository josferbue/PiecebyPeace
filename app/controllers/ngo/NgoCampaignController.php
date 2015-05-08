<?php

class NgoCampaignController extends BaseController
{
    private $_api_context;

    private $_ClientId='AQ10YGdwkquqM6DpBspIeagRqOOeGPh4Dz19832jqdbr55laVUJPxXu2BBH6M7Ay2zNbhS6L2m9GhFaj';
    private $_ClientSecret='EKwZnR0aoVXcgl4SkZgaDZeE2tctC6E0na4fEQmmcuFhyZi1l3kaS5NXQXc_IChCIePUVfgiRTPOdIgr';
    private $campaign;

    public function __construct(Campaign $campaign)
    {
        parent::__construct();
        $this->campaign = $campaign;
        // setup PayPal api context
        $this->_api_context = Paypalpayment::apiContext($this->_ClientId, $this->_ClientSecret);
        $this->_api_context->setConfig(array(
            'mode' => 'sandbox',
            'http.ConnectionTimeOut' => 30,
            'log.LogEnabled' => true,
            'log.FileName' => __DIR__.'/../PayPal.log',
            'log.LogLevel' => 'FINE'
        ));
    }

    public function findCampaignsByCurrentNGO()
    {
        if(Auth::check() && Auth::user()->hasRole('NonGovernmentalOrganization'))
        {
            $user = Auth::user();
            $ngo = Ngo::where('user_id','=',$user->id)->first();
            $campaigns = Campaign::where('ngo_id','=',$ngo->id)->paginate(3);

            $data = array(
                'campaigns' => $campaigns,
            );

            Return View::make('site/campaign/list')->with($data);
        }
        else
        {
            Return Redirect::to('/');
        }
    }

    public function createCampaign()
    {
        $backUrl=  Session::get('backUrl');

        $data = array(
            'backUrl'=>$backUrl
        );

        Return View::make('site/campaign/create')->with($data);
    }

    public function saveCampaign()
    {
        $rules = array(
            'name'                  => 'required|min:3',
            'description'           => 'required|min:3',
            'image'                 => 'image',
            'startDate'             => 'required|date|after:'.date('Y-m-d').'|before:'.Input::get('finishDate'),
            'finishDate'            => 'required|date|after:'.date('Y-m-d'),
            'link'                  => 'required|url',
            'maxVisits'             => 'required|min:0',
            'expirationDate'        => 'required|date|after:'.Input::get('startDate').'|before:'.Input::get('finishDate'),
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        $this->campaign->name = Input::get( 'name' );
        $this->campaign->description = Input::get( 'description' );
        $this->campaign->startDate = Input::get( 'startDate' );
        $this->campaign->finishDate = Input::get( 'finishDate' );
        $this->campaign->link = Input::get( 'link' );
        $this->campaign->maxVisits = Input::get( 'maxVisits' );
        $this->campaign->expirationDate = Input::get( 'expirationDate' );
        $this->campaign->ngo_id = Ngo::where('user_id','=',Auth::id())->first()->id;

        $destinationPath = public_path().'/campaigns_images/'.$this->campaign->name;

        if ($validator->passes())
        {

            $image = Input::file('image');
            if ($image != null) {
                $filename = $image->getClientOriginalName();
                $image->move($destinationPath, $filename);
                $this->campaign->image =  '/campaigns_images/'.$this->campaign->name .'/'. $filename;

            }else{
                $this->campaign->image ='/logos/imageNotFound.gif';
            }


            if(!Auth::user()->actor()->credits) {
                return Redirect::to('ngo/campaign/create')->withInput(Input::all())->with('error', Lang::get('campaign/campaign.zeroCredits'));
            }

            if(!$this->checkIfNgoHasEnoughCredits($this->campaign)) {
                return Redirect::to('ngo/campaign/create')->withInput(Input::all())->with('error', Lang::get('campaign/campaign.noEnoughCredits'));
            }

            $this->campaign->save();

            return Redirect::to('ngo/myCampaigns')->with('success', Lang::get('campaign/campaign.creationSuccessful'));
        }
        else
        {
            return Redirect::to('ngo/campaign/create')->withInput(Input::all())->withErrors($validator);
        }
    }

    public function postCreateEmailPayment()
    {

        // Declare the rules for the form validation
        $rules = array(
            'numberEmails' => 'required|integer|between:1,'.Volunteer::count(),
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
            $numberEmail = Input::get("numberEmails");
            $payer = Paypalpayment::payer();
            $payer->setPaymentMethod("paypal");

            $item1 = Paypalpayment::item();
            $item1->setName('Email Marketing Piece by Peace')
                ->setDescription('Email marketing for volunteer')
                ->setCurrency('EUR')
                ->setQuantity($numberEmail)
                ->setPrice(0.03);


            $itemList = Paypalpayment::itemList();
            $itemList->setItems(array($item1));


            $details = Paypalpayment::details();
            $details->setShipping("0")
                ->setTax(''.$numberEmail * 0.03 * 0.21)
                //total of items prices
                ->setSubtotal(''.$numberEmail * 0.03);

            //Payment Amount
            $amount = Paypalpayment::amount();
            $amount->setCurrency("EUR")
                // the total is $17.8 = (16 + 0.6) * 1 ( of quantity) + 1.2 ( of Shipping).
                ->setTotal(($numberEmail * 0.03 * 0.21) + ($numberEmail * 0.03))
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


            $redirectUrls = Paypalpayment::redirectUrls();
            $redirectUrls->setReturnUrl(URL::to('ngo/sendEmails'))
                ->setCancelUrl(URL::to('ngo/sendEmails'));

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
            Session::put('numberEmail',$numberEmail);
            Session::put('idCampaing',Input::get( 'idCampaing' ));
            if(isset($redirect_url)) {
                // redirect to paypal
                return Redirect::away($redirect_url);
            }

            return View::make('site/ngo/emails')->with('campaignId',Input::get( 'idCampaing' ))->with('campaignName',Input::get( 'campaing' ))->with('error', 'Unknown error occurred');
        }
        else {
            return View::make('site/ngo/emails')->with('campaignId',Input::get( 'idCampaing' ))->with('campaignName',Input::get( 'campaing' ))->withInput(Input::all())->withErrors($validator);
        }

    }

    public function sendEmails()
    {
        // Get the payment ID before session clear
        $payment_id = Session::get('paypal_payment_id');

        // clear the session payment ID
        Session::forget('paypal_payment_id');

        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
            return Redirect::action('BlogController@getIndex')
                ->with('error', 'Payment failed');
        }

        $payment = Paypalpayment::getById($payment_id, $this->_api_context);

        // PaymentExecution object includes information necessary
        // to execute a PayPal account payment.
        // The payer_id is added to the request query parameters
        // when the user is redirected from paypal back to your site
        $execution = Paypalpayment::PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));

        //Execute the payment
        $result = $payment->execute($execution, $this->_api_context);

        //echo '<pre>';print_r($result);echo '</pre>';exit; // DEBUG RESULT, remove it later

        if ($result->getState() == 'approved') { // payment made


            $curl = curl_init('http://10code.ip-zone.com//ccm/admin/api/version/2/&type=json');

            $postData = array(
                'function' => 'doAuthentication',
                'username' => '10code',
                'password' => 'eef6bd5d',
            );

            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($postData));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

            $json = curl_exec($curl);
            $result = json_decode($json);

            if ($result->status == 0) {
                return Redirect::action('NgoCampaignController@createEmails')
                    ->with('error', 'Authentication failure');
            }

            $camp = Campaign::find(Session::get( 'idCampaing' ));
            $numberEmail = Session::get('numberEmail');
            $arrayAux = array();
            foreach(Volunteer::all() as $aux){
                $arrayAux[]=$aux;
            }
            $volunteers = array_rand($arrayAux,$numberEmail);
            $rcpt = array();
            foreach($volunteers as $volunteer){
                $rcpt[] = array(
                    'name' => $arrayAux[$volunteer]->name,
                    'email' => $arrayAux[$volunteer]->userAccount->email
                );

            }
            /*$rcpt[] = array(
                'name' => 'Prueba',
                'email' => 'jose1561991@gmail.com'
            );*/

            $postData = array(
                'function' => 'sendMail',
                'apiKey' => $result->data,
                'subject' => $camp->ngo->name,
                'html' => '<html><head><title>'.$camp->name.'</title></head><body><h1>'.$camp->name.'</h1>'.$camp->description.' <br> </p> <a herf='.$camp->link.' >Go to link</a></body></html>',
                'mailboxFromId' => 1,
                'mailboxReplyId' => 1,
                'mailboxReportId' => 1,
                'packageId' => 6,
                'emails' => $rcpt
            );

            $post = http_build_query($postData);

            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

            $json = curl_exec($curl);
            $result = json_decode($json);

            if ($result->status == 0) {
                return Redirect::action('NgoCampaignController@findCampaignsByCurrentNGO')->with('error', 'Sending failure');
            }
            else {
                return Redirect::action('NgoCampaignController@findCampaignsByCurrentNGO')
                    ->with('success', 'Email sent successfully');
            }

        }
        return Redirect::action('NgoCampaignController@findCampaignsByCurrentNGO')->with('error', 'Payment failed');

    }

    public function createEmails($campaign)
    {


        Return View::make('site/ngo/emails')->with('campaignId',$campaign->id)->with('campaignName',$campaign->name);
    }

    public function checkIfNgoHasEnoughCredits($newCampaign) {
        $campaigns = Campaign::where('ngo_id', '=', Auth::user()->actor()->id)->where('expirationDate', '>', Carbon::now());
        $ngo = Auth::user()->actor();
        $canCreateNewCampaign = false;
        $click6 = 0;
        $click9 = 0;
        $click12 = 0;

        foreach($campaigns as $campaign)
        {
            if($campaign->visits < 201) {
                if ($campaign->maxVisits > 200) {
                    $click6 += (200 - $campaign->visits);
                    if ($campaign->maxVisits <= 1000) {
                        $click9 += ($campaign->maxVisits - 200);
                    } else {
                        $click9 += 800;
                        $click12 += ($campaign->maxVisits - 1000);
                    }
                } else {
                    $click6 += ($campaign->maxVisits - $campaign->visits);
                }
            }
            if($campaign->visits >= 201 && $campaign->visits < 1001) {
                if($campaign->maxVisits <= 1000) {
                    $click9 += ($campaign->maxVisits - $campaign->visits);
                } else {
                    $click9 += (1000 - $campaign->visits);
                    $click12 += ($campaign->maxVisits - 1000);
                }
            }
            if($campaign->visits >= 1001) {
                $click12 += ($campaign->maxVisits - $campaign->visits);
            }
        }

        $requiredCredits = 6 * $click6 + 9 * $click9 + 12 * $click12 + $newCampaign->maxVisits;

        if($ngo->credits >= $requiredCredits) {
            $canCreateNewCampaign = true;
        }

        return $canCreateNewCampaign;
    }


}