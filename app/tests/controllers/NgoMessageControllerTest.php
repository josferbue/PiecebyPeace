<?php

class NgoMessageControllerTest extends BaseControllerTestCase
{


    public function testCreateMessageResponseErrorNotAuthenticate()
    {
        $this->flushSession();


        $idProject = Project::where('name', '=', 'Limpiemos la ciudad')->first()->id;

        $this->requestAction('GET', 'NgoMessageController@createMessage', array($idProject));
        $this->assertRedirectedTo('/');
    }

    public function testCreateMessageResponseErrorHasNotVolunteers()
    {
        $this->flushSession();


        $credentials = array(
            'email' => 'eat@gmail.com',
            'password' => 'eat1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput($credentials)
            ->requestAction('POST', 'UserController@postLogin');

        $idProject = Project::where('name', '=', 'Limpiemos la ciudad')->first()->id;

        $this->requestAction('GET', 'NgoMessageController@createMessage', array($idProject));

        $this->assertRedirectedTo(Session::get('backUrl'), array('error'));

    }

    public function testCreateMessageResponseOk()
    {
        $this->flushSession();


        $credentials = array(
            'email' => 'eat@gmail.com',
            'password' => 'eat1',
            'csrf_token' => Session::getToken()
        );

        //añadimos la solicitud de un voluntario


        $this->withInput($credentials)
            ->requestAction('POST', 'UserController@postLogin');

        $idProject = 1;

        $this->requestAction('GET', 'NgoMessageController@createMessage', array($idProject));
        $this->assertViewHas('project');
        $this->assertViewHas('backUrl');
        $this->assertViewHas('volunteers');
        $this->assertViewHas('action');

    }

    public function testSendMessageErrorSubject()
    {

        $this->flushSession();


        $credentials = array(
            'email' => 'eat@gmail.com',
            'password' => 'eat1',
            'csrf_token' => Session::getToken()
        );


        //añadimos la solicitud de un voluntario

        $this->withInput($credentials)
            ->requestAction('POST', 'UserController@postLogin');

        $idProject = 1;

        $this->requestAction('GET', 'NgoMessageController@createMessage', array($idProject));


        $messageData = array(
            'type' => 'volunteer',
            'textBox' => 'Esto es un mensaje.',

        );

        $this->withInput($messageData)->requestAction('POST', 'NgoMessageController@sendMessage');
        $this->assertRedirectedTo(URL::to('ngo/message/sendMessage/'));
        $this->assertSessionHasErrors('subject');

    }

}