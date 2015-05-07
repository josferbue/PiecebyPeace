<?php

class CampaignControllerTest extends BaseControllerTestCase {

    // List of all campaigns

    public function testListAllActiveCampaignsResponse()
    {
        $this->flushSession();

        $this->requestAction('GET', 'CampaignController@findAllActiveCampaigns');
        $this->assertResponseOk();
    }

    public function testListAllActiveCampaignsVariables()
    {
        $this->flushSession();

        $this->requestAction('GET', 'CampaignController@findAllActiveCampaigns');
        $this->assertViewHas('campaigns');
    }


    /* This test can't be performed due to a JavaScript DatePicker is being used, so it's necessary to use a testing tool focused on user interactions like Selenium */
    /*public function testCreateCampaignSuccessful()
    {
        $this->flushSession();

        // Login in as ngo1
        $credentials = array(
            'email'=>'ngo1@ngo1.com',
            'password'=>'ngo1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput( $credentials )
            ->requestAction('POST', 'UserController@postLogin');

        $this->requestAction('GET', 'CampaignController@createCampaign');

        // Create new campaign
        $campaignData = array(
            'name'                          => 'Campaign 3',
            'description'                   => 'Description campaign 3',
            'image'                         =>  new Symfony\Component\HttpFoundation\File\UploadedFile('C:\ds-firebird-logo-500.png', 'ds-firebird-logo-500.png'),
            'startDate'                     =>  \Carbon\Carbon::createFromDate(2015,7,23)->toDateTimeString(),
            'finishDate'                    =>  \Carbon\Carbon::createFromDate(2015,8,23)->toDateTimeString(),
            'link'                          => 'http://www.blahblahblah3.com',
            'maxVisits'                     => 4000,
            'promotionDuration'             => 60,
        );

        $this->withInput( $campaignData )->requestAction('POST', 'CampaignController@saveCampaign');
        $this->assertRedirectedTo( URL::to('myCampaigns'));
        $this->assertViewHas('success');
    }*/



}
