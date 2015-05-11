<?php

class MessageControllerTest extends BaseControllerTestCase
{

    public function testGetInboxCompanyResponse()
{
    $this->flushSession();


    $credentials = array(
        'email' => 'xeilaale@gmail.com',
        'password' => 'xeilaale1',
        'csrf_token' => Session::getToken()
    );

    $this->withInput($credentials)
        ->requestAction('POST', 'UserController@postLogin');

    $this->requestAction('GET', 'MessageController@getInbox');
    $this->assertResponseOk();
}

    public function testGetInboxNgoResponse()
    {
        $this->flushSession();


        $credentials = array(
            'email' => 'steps@gmail.com',
            'password' => 'steps1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput($credentials)
            ->requestAction('POST', 'UserController@postLogin');

        $this->requestAction('GET', 'MessageController@getInbox');
        $this->assertResponseOk();
    }

    public function testGetInboxVolunteerResponse()
    {
        $this->flushSession();


        $credentials = array(
            'email' => 'juan@gmail.com',
            'password' => 'juan1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput($credentials)
            ->requestAction('POST', 'UserController@postLogin');

        $this->requestAction('GET', 'MessageController@getInbox');
        $this->assertResponseOk();
    }

    public function testGetInboxAdminResponse()
    {
        $this->flushSession();


        $credentials = array(
            'email' => 'admin1@piecebypeace.com',
            'password' => 'admin1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput($credentials)
            ->requestAction('POST', 'UserController@postLogin');

        $this->requestAction('GET', 'MessageController@getInbox');
        $this->assertResponseOk();
    }

    public function testGetInboxNotAuthenticated()
    {
        $this->flushSession();

        $this->requestAction('GET', 'MessageController@getInbox');
        $this->assertRedirectedTo('/');
    }
    public function testGetSentCompanyResponse()
    {
        $this->flushSession();


        $credentials = array(
            'email' => 'xeilaale@gmail.com',
            'password' => 'xeilaale1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput($credentials)
            ->requestAction('POST', 'UserController@postLogin');

        $this->requestAction('GET', 'MessageController@getSent');
        $this->assertResponseOk();
    }

    public function testGetSentNgoResponse()
    {
        $this->flushSession();


        $credentials = array(
            'email' => 'steps@gmail.com',
            'password' => 'steps1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput($credentials)
            ->requestAction('POST', 'UserController@postLogin');

        $this->requestAction('GET', 'MessageController@getSent');
        $this->assertResponseOk();
    }

    public function testGetSentVolunteerResponse()
    {
        $this->flushSession();


        $credentials = array(
            'email' => 'juan@gmail.com',
            'password' => 'juan1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput($credentials)
            ->requestAction('POST', 'UserController@postLogin');

        $this->requestAction('GET', 'MessageController@getSent');
        $this->assertResponseOk();
    }

    public function testGetSentAdminResponse()
    {
        $this->flushSession();


        $credentials = array(
            'email' => 'admin1@piecebypeace.com',
            'password' => 'admin1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput($credentials)
            ->requestAction('POST', 'UserController@postLogin');

        $this->requestAction('GET', 'MessageController@getInbox');
        $this->assertResponseOk();
    }

    public function testGetSentNotAuthenticated()
    {
        $this->flushSession();

        $this->requestAction('GET', 'MessageController@getSent');
        $this->assertRedirectedTo('/');
    }



}