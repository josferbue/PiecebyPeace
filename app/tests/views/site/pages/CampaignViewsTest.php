<?php

class CampaignViewsTest extends BaseControllerTestCase {

    // Creation of campaigns

    public function testCreateResponse()
    {
        // Login in as ngo1
        $credentials = array(
            'email'=>'greenone@gmail.com',
            'password'=>'greenone1',
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

        $this->assertCount(1, $crawler->filter('h3:contains("Campaña de recaudación de fondos")'));
    }

    public function testCampaign1NameLinkToDetails()
    {
        $crawler = $this->client->request('GET', URL::to('campaign/findActive'));

        $link = $crawler->selectLink('Campaña de recaudación de fondos')->link();

        $url = $link->getUri();

        $this->assertEqualsUrlPath($url, 'campaign/details/3');
    }

    // List campaigns logged in as ngo1

    public function testListNGOActiveCampaignsResponse()
    {
        // Login in as ngo1
        $credentials = array(
            'email'=>'greenone@gmail.com',
            'password'=>'greenone1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput( $credentials )
            ->requestAction('POST', 'UserController@postLogin');

        $crawler = $this->client->request('GET', URL::to('ngo/myActiveCampaigns'));

        $this->assertTrue($this->client->getResponse()->isOk());
    }

    public function testListNGOCampaignsResponseNotAuthenticated()
    {
        $crawler = $this->client->request('GET', URL::to('ngo/myActiveCampaigns'));

        $this->assertRedirection( URL::to('/') );
    }

    public function testNGOCampaign1Name()
    {
        // Login in as ngo1
        $credentials = array(
            'email'=>'greenone@gmail.com',
            'password'=>'greenone1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput( $credentials )
            ->requestAction('POST', 'UserController@postLogin');

        $crawler = $this->client->request('GET', URL::to('ngo/myActiveCampaigns'));

        $this->assertCount(1, $crawler->filter('h3:contains("Campaña de recaudación de fondos")'));
    }

    public function testNGOCampaign1NameLinkToDetails()
    {
        // Login in as ngo1
        $credentials = array(
            'email'=>'greenone@gmail.com',
            'password'=>'greenone1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput( $credentials )
            ->requestAction('POST', 'UserController@postLogin');

        $crawler = $this->client->request('GET', URL::to('ngo/myActiveCampaigns'));

        $link = $crawler->selectLink('Campaña de recaudación de fondos')->link();

        $url = $link->getUri();

        $this->assertEqualsUrlPath($url, 'campaign/details/3');
    }

    // Details of campaigns

    public function testDetailsCampaign3Response()
    {
        $crawler = $this->client->request('GET', URL::to('/campaign/details/3'));

        $this->assertTrue($this->client->getResponse()->isOk());
    }

    public function testDetailsCampaign3Description()
    {
        $crawler = $this->client->request('GET', URL::to('/campaign/details/3'));

        $this->assertCount(1, $crawler->filter('p:contains("Esta campaña tiene como objetivo la recaudación de fondos para proyectos de voluntariado.")'));
    }


}