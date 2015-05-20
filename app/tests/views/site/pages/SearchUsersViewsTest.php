<?php

class SearchUsersViewsTest extends BaseControllerTestCase {

    // Users searching (volunteers)

    public function testSearchVolunteersResponse()
    {
        // Login in as ngo1
        $credentials = array(
            'email'=>'admin1@piecebypeace.com',
            'password'=>'admin1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput( $credentials )
            ->requestAction('POST', 'UserController@postLogin');

        $crawler = $this->client->request('GET', URL::to('admin/search/searchVolunteers'));

        $this->assertResponseOk();
    }

    public function testSearchVolunteersNotAuthenticated()
    {
        $crawler = $this->client->request('GET', URL::to('admin/search/searchVolunteers'));
        $this->assertRedirection( URL::to('/') );
    }

    public function testSearchVolunteersPerformSearch()
    {
        // Login in as ngo1
        $credentials = array(
            'email'=>'admin1@piecebypeace.com',
            'password'=>'admin1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput( $credentials )
            ->requestAction('POST', 'UserController@postLogin');

        $crawler = $this->client->request('GET', URL::to('admin/search/findVolunteers?username=raquel'));

        $this->assertCount(1, $crawler->filter('h3:contains("Raquel Cumplido (raquel)")'));
    }

    // Users searching (companies)

    public function testSearchCompaniesResponse()
    {
        // Login in as ngo1
        $credentials = array(
            'email'=>'admin1@piecebypeace.com',
            'password'=>'admin1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput( $credentials )
            ->requestAction('POST', 'UserController@postLogin');

        $crawler = $this->client->request('GET', URL::to('admin/search/searchCompanies'));

        $this->assertResponseOk();
    }

    public function testSearchCompaniesNotAuthenticated()
    {
        $crawler = $this->client->request('GET', URL::to('admin/search/searchCompanies'));
        $this->assertRedirection( URL::to('/') );
    }

    public function testSearchCompaniesPerformSearch()
    {
        // Login in as ngo1
        $credentials = array(
            'email'=>'admin1@piecebypeace.com',
            'password'=>'admin1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput( $credentials )
            ->requestAction('POST', 'UserController@postLogin');

        $crawler = $this->client->request('GET', URL::to('admin/search/findCompanies?username=boliri'));

        $this->assertCount(1, $crawler->filter('h3:contains("Boliri Association (boliri)")'));
    }

    // Users searching (NGOs)

    public function testSearchNGOsResponse()
    {
        // Login in as ngo1
        $credentials = array(
            'email'=>'admin1@piecebypeace.com',
            'password'=>'admin1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput( $credentials )
            ->requestAction('POST', 'UserController@postLogin');

        $crawler = $this->client->request('GET', URL::to('admin/search/searchNGOs'));

        $this->assertResponseOk();
    }

    public function testSearchNGOsNotAuthenticated()
    {
        $crawler = $this->client->request('GET', URL::to('admin/search/searchNGOs'));
        $this->assertRedirection( URL::to('/') );
    }

    public function testSearchNGOsPerformSearch()
    {
        // Login in as ngo1
        $credentials = array(
            'email'=>'admin1@piecebypeace.com',
            'password'=>'admin1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput( $credentials )
            ->requestAction('POST', 'UserController@postLogin');

        $crawler = $this->client->request('GET', URL::to('admin/search/findCompanies?username=eat'));

        $this->assertCount(1, $crawler->filter('h3:contains("Eat Innovations (eat)")'));
    }

}