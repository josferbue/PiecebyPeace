<?php

/**
 * Created by PhpStorm.
 * User: Alejandro
 * Date: 06/05/2015
 * Time: 23:26
 */
class NgoCampaignControllerTest extends BaseControllerTestCase
{
    // List of NGO campaigns

    public function testListNGOCampaignsResponse()
    {
        $this->flushSession();

        // Login in as ngo1
        $credentials = array(
            'email' => 'eat@gmail.com',
            'password' => 'eat1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput($credentials)
            ->requestAction('POST', 'UserController@postLogin');

        $this->requestAction('GET', 'NgoCampaignController@findActiveCampaignsByCurrentNGO');
        $this->assertResponseOk();
    }

    public function testListNGOCampaignsNotAuthenticated()
    {
        $this->flushSession();

        $this->requestAction('GET', 'NgoCampaignController@findActiveCampaignsByCurrentNGO');
        $this->assertRedirectedTo('/');
    }

    public function testListNGOCampaignsAuthenticatedAsACompany()
    {
        $this->flushSession();

        // Login in as company1
        $credentials = array(
            'email' => 'company@company1.com',
            'password' => 'company1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput($credentials)
            ->requestAction('POST', 'UserController@postLogin');

        $this->requestAction('GET', 'NgoCampaignController@findActiveCampaignsByCurrentNGO');
        $this->assertRedirectedTo('/');
    }

    public function testListNGOCampaignsVariables()
    {
        $this->flushSession();

        // Login in as ngo1
        $credentials = array(
            'email' => 'eat@gmail.com',
            'password' => 'eat1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput($credentials)
            ->requestAction('POST', 'UserController@postLogin');

        $this->requestAction('GET', 'NgoCampaignController@findActiveCampaignsByCurrentNGO');
        $this->assertViewHas('campaigns');
    }



    // Creation of a new campaign

    public function testCreateCampaignResponse()
    {
        $this->flushSession();

        // Login in as ngo1
        $credentials = array(
            'email' => 'eat@gmail.com',
            'password' => 'eat1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput($credentials)
            ->requestAction('POST', 'UserController@postLogin');

        $this->requestAction('GET', 'NgoCampaignController@createCampaign');
        $this->assertResponseOk();
    }


    public function testCreateCampaignRequiredField()
    {
        $this->flushSession();

        // Login in as ngo1
        $credentials = array(
            'email' => 'eat@gmail.com',
            'password' => 'eat1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput($credentials)
            ->requestAction('POST', 'UserController@postLogin');

        $this->requestAction('GET', 'NgoCampaignController@createCampaign');

        // Create new campaign
        $campaignData = array(
            'description' => 'Description campaign 3',
            'startDate' => \Carbon\Carbon::createFromDate(2015, 7, 23)->toDateTimeString(),
            'finishDate' => \Carbon\Carbon::createFromDate(2015, 8, 23)->toDateTimeString(),
            'link' => 'http://www.blahblahblah3.com',
            'maxVisits' => '4000',
            'promotionDuration' => 60,
        );

        $this->withInput($campaignData)->requestAction('POST', 'NgoCampaignController@saveCampaign');
        $this->assertRedirectedTo(URL::to('ngo/campaign/create'));
        $this->assertSessionHasErrors('name');
    }

    public function testCreateCampaignNotEnoughLength()
    {
        $this->flushSession();

        // Login in as ngo1
        $credentials = array(
            'email' => 'eat@gmail.com',
            'password' => 'eat1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput($credentials)
            ->requestAction('POST', 'UserController@postLogin');

        $this->requestAction('GET', 'NgoCampaignController@createCampaign');

        // Create new campaign
        $campaignData = array(
            'name' => 'Ca',
            'description' => 'Description campaign 3',
            'startDate' => \Carbon\Carbon::createFromDate(2015, 7, 23)->toDateTimeString(),
            'finishDate' => \Carbon\Carbon::createFromDate(2015, 8, 23)->toDateTimeString(),
            'link' => 'http://www.blahblahblah3.com',
            'maxVisits' => 4000,
            'promotionDuration' => 60,
        );

        $this->withInput($campaignData)->requestAction('POST', 'NgoCampaignController@saveCampaign');
        $this->assertRedirectedTo(URL::to('ngo/campaign/create'));
        $this->assertSessionHasErrors('name');
    }

    public function testCreateCampaignImageFieldIsNotAnImage()
    {
        $this->flushSession();

        // Login in as ngo1
        $credentials = array(
            'email' => 'eat@gmail.com',
            'password' => 'eat1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput($credentials)
            ->requestAction('POST', 'UserController@postLogin');

        $this->requestAction('GET', 'NgoCampaignController@createCampaign');

        // Create new campaign
        $campaignData = array(
            'name' => 'Campaign 3',
            'description' => 'Description campaign 3',
            'image' => 'abc',
            'startDate' => \Carbon\Carbon::createFromDate(2015, 7, 23)->toDateTimeString(),
            'finishDate' => \Carbon\Carbon::createFromDate(2015, 8, 23)->toDateTimeString(),
            'link' => 'http://www.blahblahblah3.com',
            'maxVisits' => 4000,
            'promotionDuration' => 60,
        );

        $this->withInput($campaignData)->requestAction('POST', 'NgoCampaignController@saveCampaign');
        $this->assertRedirectedTo(URL::to('ngo/campaign/create'));
        $this->assertSessionHasErrors('image');
    }

    public function testCreateCampaignLinkFieldDoesNotMatchPattern()
    {
        $this->flushSession();

        // Login in as ngo1
        $credentials = array(
            'email' => 'eat@gmail.com',
            'password' => 'eat1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput($credentials)
            ->requestAction('POST', 'UserController@postLogin');

        $this->requestAction('GET', 'NgoCampaignController@createCampaign');

        // Create new campaign
        $campaignData = array(
            'name' => 'Campaign 3',
            'description' => 'Description campaign 3',
            'startDate' => \Carbon\Carbon::createFromDate(2015, 7, 23)->toDateTimeString(),
            'finishDate' => \Carbon\Carbon::createFromDate(2015, 8, 23)->toDateTimeString(),
            'link' => 'abc',
            'maxVisits' => 4000,
            'promotionDuration' => 60,
        );

        $this->withInput($campaignData)->requestAction('POST', 'NgoCampaignController@saveCampaign');
        $this->assertRedirectedTo(URL::to('ngo/campaign/create'));
        $this->assertSessionHasErrors('link');
    }

}

