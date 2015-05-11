<?php

class VolunteerProjectListViewsTest extends BaseControllerTestCase {


    public function testCreateResponse()
    {
        $credentials = array(
            'email'=>'steps@gmail.com',
            'password'=>'steps1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput( $credentials )
            ->requestAction('POST', 'UserController@postLogin');

        $crawler = $this->client->request('GET', URL::to('ngo/project/createVolunteerProject'));

        $this->assertResponseOk();
    }

    public function testCreateResponseNotAuthenticated()
    {
        $crawler = $this->client->request('GET', URL::to('ngo/project/createVolunteerProject'));

        $this->assertRedirection( URL::to('/') );
    }

    public function testListVolunteerProjectResponse()
    {
        $crawler = $this->client->request('GET', URL::to('projects'));

        $this->assertTrue($this->client->getResponse()->isOk());
    }





    public function testListNGOVolunteerProjectResponse()
    {
        $credentials = array(
            'email'=>'steps@gmail.com',
            'password'=>'steps1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput( $credentials )
            ->requestAction('POST', 'UserController@postLogin');

        $crawler = $this->client->request('GET', URL::to('ngo/project/myVolunteersProjects'));

        $this->assertTrue($this->client->getResponse()->isOk());
    }

    public function testListNGOVolunteerProjectResponseNotAuthenticated()
    {
        $crawler = $this->client->request('GET', URL::to('ngo/project/myVolunteersProjects'));

        $this->assertRedirection( URL::to('/') );
    }

    public function testNGOVolunteerProject1Name()
    {
        $credentials = array(
            'email'=>'steps@gmail.com',
            'password'=>'steps1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput( $credentials )
            ->requestAction('POST', 'UserController@postLogin');

        $crawler = $this->client->request('GET', URL::to('ngo/project/myVolunteersProjects'));

        $this->assertCount(1, $crawler->filter('h3:contains("Ayuda en Togo")'));
    }

    public function testNGOVolunteerProject1NameLinkToDetails()
    {
        $credentials = array(
            'email'=>'steps@gmail.com',
            'password'=>'steps1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput( $credentials )
            ->requestAction('POST', 'UserController@postLogin');

        $crawler = $this->client->request('GET', URL::to('ngo/project/myVolunteersProjects'));

        $link = $crawler->selectLink('Ayuda en Togo')->link();

        $url = $link->getUri();

        $this->assertEqualsUrlPath($url, 'project/view/6');
    }


    public function testDetailsVolunteerProject1Response()
    {
        $crawler = $this->client->request('GET', URL::to('project/view/1'));

        $this->assertTrue($this->client->getResponse()->isOk());
    }
}