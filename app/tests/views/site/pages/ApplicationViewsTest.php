<?php

class ApplicationViewsTest extends BaseControllerTestCase {

    // Creation of applications

    public function testCreateResponse()
    {
        // Login in as ngo1
        $credentials = array(
            'email'=>'raquel@gmail.com',
            'password'=>'raquel1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput( $credentials )
            ->requestAction('POST', 'UserController@postLogin');


        $crawler = $this->client->request('GET', URL::to('volunteer/apply/project/1'));

        $this->assertResponseOk();
    }

    public function testCreateResponseNotAuthenticated()
    {
        $crawler = $this->client->request('GET', URL::to('volunteer/apply/project/1'));
        $this->assertRedirection( URL::to('/') );
    }

    // List of applications and its details (volunteer)

    public function testListCSRProjectsApplicationsResponse()
    {
        // Login in as ngo1
        $credentials = array(
            'email'=>'raquel@gmail.com',
            'password'=>'raquel1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput( $credentials )
            ->requestAction('POST', 'UserController@postLogin');


        $crawler = $this->client->request('GET', URL::to('volunteer/application/Csr'));

        $this->assertResponseOk();
    }

    public function testListCSRProjectsApplicationsNoApplications()
    {
        // Login in as ngo1
        $credentials = array(
            'email'=>'raquel@gmail.com',
            'password'=>'raquel1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput( $credentials )
            ->requestAction('POST', 'UserController@postLogin');


        $crawler = $this->client->request('GET', URL::to('volunteer/application/Csr'));
        $this->assertCount(1, $crawler->filter('h3:contains("'.Lang::get('application/list.empty').'")'));
    }

    public function testListVolunteeringProjectsApplicationsResponse()
    {
        // Login in as ngo1
        $credentials = array(
            'email'=>'raquel@gmail.com',
            'password'=>'raquel1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput( $credentials )
            ->requestAction('POST', 'UserController@postLogin');


        $crawler = $this->client->request('GET', URL::to('volunteer/application/Volunteer'));

        $this->assertResponseOk();
    }

    public function testListCSRProjectsApplicationsCheckExistingOne()
    {
        // Login in as ngo1
        $credentials = array(
            'email'=>'raquel@gmail.com',
            'password'=>'raquel1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput( $credentials )
            ->requestAction('POST', 'UserController@postLogin');


        $crawler = $this->client->request('GET', URL::to('volunteer/application/Csr'));
        $this->assertCount(0, $crawler->filter('h3:contains("Limpiemos la ciudad")'));
    }

    public function testVolunteeringProjectApplicationDetailsResponse()
    {
        // Login in as ngo1
        $credentials = array(
            'email'=>'raquel@gmail.com',
            'password'=>'raquel1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput( $credentials )
            ->requestAction('POST', 'UserController@postLogin');


        $crawler = $this->client->request('GET', URL::to('volunteer/application/view/1'));

        $this->assertResponseOk();
    }

    public function testVolunteeringProjectApplicationCheckDetails()
    {
        // Login in as ngo1
        $credentials = array(
            'email'=>'raquel@gmail.com',
            'password'=>'raquel1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput( $credentials )
            ->requestAction('POST', 'UserController@postLogin');


        $crawler = $this->client->request('GET', URL::to('volunteer/application/view/1'));
        $this->assertCount(1, $crawler->filter('p:contains("Buenas. Me gustaría participar en este proyecto de voluntariado.")'));
    }

}