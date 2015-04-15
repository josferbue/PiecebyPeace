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
        $campaigns = Campaign::paginate(4);

        $data = array(
            'campaigns' => $campaigns,
        );

        Return View::make('site/campaign/list')->with($data);
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

}