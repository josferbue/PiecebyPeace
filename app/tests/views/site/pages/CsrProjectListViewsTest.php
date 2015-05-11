<?php

class CsrProjectListViewsTest extends BaseControllerTestCase {


    public function testCreateResponse()
    {
        // Login in as company1
        $credentials = array(
            'email'=>'xeilaale@gmail.com',
            'password'=>'xeilaale1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput( $credentials )
            ->requestAction('POST', 'UserController@postLogin');

         $this->client->request('GET', URL::to('company/project/createCsrProject'));

        $this->assertResponseOk();
    }

    public function testCreateResponseNotAuthenticated()
    {
        $this->client->request('GET', URL::to('company/project/createCsrProject'));

        $this->assertRedirection( URL::to('/') );
    }

    public function testListCsrProjectResponse()
    {
        $this->client->request('GET', URL::to('projectsCsr'));

        $this->assertTrue($this->client->getResponse()->isOk());
    }


    public function testListCompanyCsrProjectResponse()
    {
        $credentials = array(
            'email'=>'xeilaale@gmail.com',
            'password'=>'xeilaale1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput( $credentials )
            ->requestAction('POST', 'UserController@postLogin');

        $crawler = $this->client->request('GET', URL::to('company/project/myCsrProjects'));

        $this->assertTrue($this->client->getResponse()->isOk());
    }

    public function testListCompanyCsrProjectResponseNotAuthenticated()
    {
        $crawler = $this->client->request('GET', URL::to('company/project/myCsrProjects'));

        $this->assertRedirection( URL::to('/') );
    }

    public function testCompanyCsrProject1Name()
    {
        $credentials = array(
            'email'=>'xeilaale@gmail.com',
            'password'=>'xeilaale1',
            'csrf_token' => Session::getToken()
        );


        $this->withInput( $credentials )
            ->requestAction('POST', 'UserController@postLogin');

        $crawler = $this->client->request('GET', URL::to('company/project/myCsrProjects'));

        $this->assertCount(1, $crawler->filter('h3:contains("Prevención de la violencia")'));
    }

    public function testDetailsCsrProject1Response()
    {
        $crawler = $this->client->request('GET', URL::to('projectCsr/view/2'));

        $this->assertTrue($this->client->getResponse()->isOk());
    }
}