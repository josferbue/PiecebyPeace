<?php

class CampaignController extends BaseController
{
    public function __construct(Campaign $campaign, Visitor $visitor, Ngo $ngo)
    {
        parent::__construct();
        $this->campaign = $campaign;
        $this->visitor = $visitor;
        $this->ngo = $ngo;
    }

    public function findAllActiveCampaigns()
    {
        $campaigns = Campaign::where('expirationDate', '>', Carbon::now())->whereRaw('visits < maxVisits')->paginate(4);

        $data = array(
            'campaigns' => $campaigns,
        );

        Return View::make('site/campaign/list')->with($data);
    }

    public function campaignDetails($id)
    {
        $campaign = Campaign::where('id', '=', $id)->first();
        $ngo = Ngo::where('id', '=', $campaign->ngo_id)->first();
        $backUrl = Session::get('backUrl');

        $data = array(
            'campaign' => $campaign,
            'ngo' => $ngo,
            'backUrl' => $backUrl,
        );

        if (Carbon::now() > $campaign->expirationDate || $campaign->visits >= $campaign->maxVisits) {
            if (Auth::user() && Auth::user()->hasRole('NonGovernmentalOrganization')) {
                $ngo = Auth::user()->actor();
                if ($campaign->ngo_id == $ngo->id) {
                    Return View::make('site/campaign/details', $data);
                }
            }
            Return Redirect::to($backUrl)->with('error', Lang::get('campaign/campaign.campaignNoLongerAvailable'));

        } else {

            Return View::make('site/campaign/details', $data);

        }

    }

    public function payToClick($id)
    {

        $userIP = Request::ip();
        $user = Auth::user();
        $this->campaign = Campaign::find($id);
        $this->ngo = Ngo::find($this->campaign->ngo_id);

        if ($user) {
            if ($user->actor() != $this->campaign->ngo && $this->campaign->visits <= $this->campaign->maxVisits &&
                $this->campaign->expirationDate >= Carbon::now() && !Visitor::where('ipAddress', '=', $userIP)->where('campaign_id', '=', $this->campaign->id)->first()
            ) {
                if (count(Campaign::where('ngo_id', '=', $this->campaign->ngo->id)->get()) <= 2) {
                    Return Redirect::to($this->campaign->link);
                }
                if (count(Campaign::where('ngo_id', '=', $this->campaign->ngo->id)->get()) > 2) {
                    if ($this->campaign->visits <= 200) {
                        $this->ngo->credits = $this->ngo->credits - 6;
                        $this->ngo->save();
                    }
                    if ($this->campaign->visits > 200 && $this->campaign->visits <= 1000) {
                        $this->ngo->credits = $this->ngo->credits - 9;
                        $this->ngo->save();
                    }
                    if ($this->campaign->visits > 1000) {
                        $this->ngo->credits = $this->ngo->credits - 12;
                        $this->ngo->save();
                    }
                }
            }
        } else {
            if ($this->campaign->visits <= $this->campaign->maxVisits &&
                $this->campaign->expirationDate >= Carbon::now() && !Visitor::where('ipAddress', '=', $userIP)->where('campaign_id', '=', $this->campaign->id)->first()
            ) {
                if (count(Campaign::where('ngo_id', '=', $this->campaign->ngo->id)->get()) <= 2) {
                    Return Redirect::to($this->campaign->link);
                }
                if (count(Campaign::where('ngo_id', '=', $this->campaign->ngo->id)->get()) > 2) {
                    if ($this->campaign->visits <= 200) {
                        $this->ngo->credits = $this->ngo->credits - 6;
                        $this->ngo->save();
                    }
                    if ($this->campaign->visits > 200 && $this->campaign->visits <= 1000) {
                        $this->ngo->credits = $this->ngo->credits - 9;
                        $this->ngo->save();
                    }
                    if ($this->campaign->visits > 1000) {
                        $this->ngo->credits = $this->ngo->credits - 12;
                        $this->ngo->save();
                    }
                }
            }
        }

        if (!Visitor::where('ipAddress', '=', $userIP)->where('campaign_id', '=', $this->campaign->id)->first()) {
            $this->visitor->ipAddress = $userIP;
            $this->visitor->campaign_id = $this->campaign->id;
            $this->visitor->save();
        }

        $this->campaign->visits = $this->campaign->visits + 1;
        $this->campaign->save();
        Return Redirect::to($this->campaign->link);
    }

}