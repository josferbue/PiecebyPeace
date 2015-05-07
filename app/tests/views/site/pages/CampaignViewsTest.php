<?php

class CampaignViewsTest extends BaseControllerTestCase {

    // Creation of campaigns

    public function testCreateResponse()
    {
        // Login in as ngo1
        $credentials = array(
            'email'=>'ngo1@ngo1.com',
            'password'=>'ngo1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput( $credentials )
            ->requestAction('POST', 'UserController@postLogin');


        $crawler = $this->client->request('GET', URL::to('ngo/campaign/create'));

        $this->assertResponseOk();
    }

    public function testCreateResponseNotAuthenticated()
    {
        $crawler = $this->client->request('GET', URL::to('ngo/campaign/create'));

        $this->assertRedirection( URL::to('/') );
    }

    // List of all campaigns

    public function testListActiveCampaignsResponse()
    {
        $crawler = $this->client->request('GET', URL::to('campaign/findActive'));

        $this->assertTrue($this->client->getResponse()->isOk());
    }

    public function testCampaign1Name()
    {
        $crawler = $this->client->request('GET', URL::to('campaign/findActive'));

        $this->assertCount(1, $crawler->filter('h3:contains("Campaign 1")'));
    }

    public function testCampaign2Name()
    {
        $crawler = $this->client->request('GET', URL::to('campaign/findActive'));

        $this->assertCount(1, $crawler->filter('h3:contains("Campaign 2")'));
    }

    public function testCampaign1NameLinkToDetails()
    {
        $crawler = $this->client->request('GET', URL::to('campaign/findActive'));

        $link = $crawler->selectLink('Campaign 1')->link();

        $url = $link->getUri();

        $this->assertEqualsUrlPath($url, 'campaign/details/1');
    }

    public function testCampaign2NameLinkToDetails()
    {
        $crawler = $this->client->request('GET', URL::to('campaign/findActive'));

        $link = $crawler->selectLink('Campaign 2')->link();

        $url = $link->getUri();

        $this->assertEqualsUrlPath($url, 'campaign/details/2');
    }

    // List campaigns logged in as ngo1

    public function testListNGOCampaignsResponse()
    {
        // Login in as ngo1
        $credentials = array(
            'email'=>'ngo1@ngo1.com',
            'password'=>'ngo1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput( $credentials )
            ->requestAction('POST', 'UserController@postLogin');

        $crawler = $this->client->request('GET', URL::to('ngo/myCampaigns'));

        $this->assertTrue($this->client->getResponse()->isOk());
    }

    public function testListNGOCampaignsResponseNotAuthenticated()
    {
        $crawler = $this->client->request('GET', URL::to('ngo/myCampaigns'));

        $this->assertRedirection( URL::to('/') );
    }

    public function testNGOCampaign1Name()
    {
        // Login in as ngo1
        $credentials = array(
            'email'=>'ngo1@ngo1.com',
            'password'=>'ngo1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput( $credentials )
            ->requestAction('POST', 'UserController@postLogin');

        $crawler = $this->client->request('GET', URL::to('ngo/myCampaigns'));

        $this->assertCount(1, $crawler->filter('h3:contains("Campaign 1")'));
    }

    public function testNGOCampaign1NameLinkToDetails()
    {
        // Login in as ngo1
        $credentials = array(
            'email'=>'ngo1@ngo1.com',
            'password'=>'ngo1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput( $credentials )
            ->requestAction('POST', 'UserController@postLogin');

        $crawler = $this->client->request('GET', URL::to('ngo/myCampaigns'));

        $link = $crawler->selectLink('Campaign 1')->link();

        $url = $link->getUri();

        $this->assertEqualsUrlPath($url, 'campaign/details/1');
    }

    // Details of campaigns

    public function testDetailsCampaign1Response()
    {
        $crawler = $this->client->request('GET', URL::to('/campaign/details/1'));

        $this->assertTrue($this->client->getResponse()->isOk());
    }

    public function testDetailsCampaign2Response()
    {
        $crawler = $this->client->request('GET',URL::to( '/campaign/details/2'));

        $this->assertTrue($this->client->getResponse()->isOk());
    }

    public function testDetailsCampaign1Description()
    {
        $crawler = $this->client->request('GET', URL::to('/campaign/details/1'));

        $this->assertCount(1, $crawler->filter('p:contains("Description campaign 1")'));
    }

    public function testDetailsCampaign2Description()
    {
        $crawler = $this->client->request('GET', URL::to('/campaign/details/2'));

        $this->assertCount(1, $crawler->filter('p:contains("Description campaign 2")'));
    }

}