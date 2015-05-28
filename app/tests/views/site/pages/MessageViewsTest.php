<?php

class MessageViewsTest extends BaseControllerTestCase {

    // Creation of messages

    public function testCreateAsNGOResponse()
    {
        // Login in as ngo1
        $credentials = array(
            'email'=>'greenone@gmail.com',
            'password'=>'greenone1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput( $credentials )
            ->requestAction('POST', 'UserController@postLogin');


        $crawler = $this->client->request('GET', URL::to('ngo/message/sendMessage/1'));

        $this->assertResponseOk();
    }

    public function testCreateAsVolunteerResponse()
    {
        // Login in as ngo1
        $credentials = array(
            'email'=>'raquel@gmail.com',
            'password'=>'raquel1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput( $credentials )
            ->requestAction('POST', 'UserController@postLogin');


        $crawler = $this->client->request('GET', URL::to('volunteer/message/sendMessage/1'));

        $this->assertResponseOk();
    }

    public function testCreateAsAdminResponse()
    {
        // Login in as ngo1
        $credentials = array(
            'email'=>'admin1@piecebypeace.com',
            'password'=>'admin1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput( $credentials )
            ->requestAction('POST', 'UserController@postLogin');


        $crawler = $this->client->request('GET', URL::to('admin/message/sendMessage/1'));

        $this->assertResponseOk();
    }

    public function testBroadcastAsAdminResponse()
    {
        // Login in as ngo1
        $credentials = array(
            'email'=>'admin1@piecebypeace.com',
            'password'=>'admin1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput( $credentials )
            ->requestAction('POST', 'UserController@postLogin');


        $crawler = $this->client->request('GET', URL::to('admin/message/broadcastMessage'));

        $this->assertResponseOk();
    }

    public function testCreateResponseNotAuthenticated()
    {
        $crawler = $this->client->request('GET', URL::to('ngo/message/sendMessage/2'));
        $this->assertRedirection( URL::to('/') );

        $crawler = $this->client->request('GET', URL::to('company/message/sendMessage/2'));
        $this->assertRedirection( URL::to('/') );

        $crawler = $this->client->request('GET', URL::to('volunteer/message/sendMessage/2'));
        $this->assertRedirection( URL::to('/') );
    }

    public function testBroadcastResponseNotAuthenticated()
    {
        $crawler = $this->client->request('GET', URL::to('admin/message/broadcastMessage'));
        $this->assertRedirection( URL::to('/') );
    }

}