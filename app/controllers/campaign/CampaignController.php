<?php

class CampaignController extends BaseController
{
    public function __construct(Campaign $campaign)
    {
        parent::__construct();
        $this->campaign = $campaign;
    }

    public function findAllCampaigns()
    {
        $campaigns = Campaign::all();

        $data = array(
            'campaigns' => $campaigns,
        );

        Return View::make('site/campaign/list')->with($data);
    }

    public function findCampaignsByCurrentNGO()
    {
        if(Auth::check() && Auth::user()->hasRole('NonGovernmentalOrganization'))
        {
            $user = Auth::user();
            $ngo = Ngo::where('user_id','=',$user->id)->first();
            $campaigns = $ngo->campaigns;

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

    public function campaignDetails($id)
    {
        $campaign = Campaign::where('id','=',$id)->first();
        $ngo = Ngo::where('id','=',$campaign->ngo_id)->first();

        $data = array(
            'campaign' => $campaign,
            'ngo' => $ngo,
        );

        Return View::make('site/campaign/details', $data);
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
            'image'                 => 'required|image',
            'startDate'             => 'required|date|after:'.date('Y-m-d').'|before:'.Input::get('finishDate'),
            'finishDate'            => 'required|date|after:'.date('Y-m-d'),
            'link'                  => 'required|url',
            'maxVisits'             => 'required|min:0',
            'promotionDuration'     => 'required|min:1',
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        $this->campaign->name = Input::get( 'name' );
        $this->campaign->description = Input::get( 'description' );
        $this->campaign->startDate = Input::get( 'startDate' );
        $this->campaign->finishDate = Input::get( 'finishDate' );
        $this->campaign->link = Input::get( 'link' );
        $this->campaign->promotionDuration = Input::get( 'promotionDuration' );
        $this->campaign->ngo_id = Ngo::where('user_id','=',Auth::id())->first()->id;

        $destinationPath = public_path().'/campaigns_images/'.$this->campaign->name;

        if ($validator->passes())
        {
            $image = Input::file('image');
            $filename = $image->getClientOriginalName();
            $image->move($destinationPath, $filename);
            $this->campaign->image =  '/campaigns_images/'.$this->campaign->name .'/'. $filename;

            $this->campaign->save();

            return Redirect::to('myCampaigns')->with('success', Lang::get('campaign/campaign.creationSuccessful'));
        }
        else
        {
            return Redirect::to('campaign/create')->withInput(Input::all())->withErrors($validator);
        }
    }

}