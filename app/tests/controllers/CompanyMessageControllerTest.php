<?php

class CompanyMessageControllerTest extends BaseControllerTestCase
{


    public function testCreateMessageResponseErrorNotAuthenticate()
    {
        $this->flushSession();


        $idProject = Project::whereNull('ngo_id')->first()->id;

        $this->requestAction('GET', 'CompanyMessageController@createMessage', array($idProject));
        $this->assertRedirectedTo('/');
    }

    public function testCreateMessageResponseErrorHasNotVolunteers()
    {
        $this->flushSession();


        $credentials = array(
            'email' => 'xeilaale@gmail.com',
            'password' => 'xeilaale1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput($credentials)
            ->requestAction('POST', 'UserController@postLogin');

        $idProject = Project::whereNull('ngo_id')->first()->id;

        $this->requestAction('GET', 'CompanyMessageController@createMessage', array($idProject));

        $this->assertRedirectedTo(Session::get('backUrl'), array('error'));

    }

    public function testCreateMessageResponseOk()
    {
        $this->flushSession();


        $credentials = array(
            'email' => 'xeilaale@gmail.com',
            'password' => 'xeilaale1',
            'csrf_token' => Session::getToken()
        );

        //añadimos la solicitud de un voluntario


        $this->withInput($credentials)
            ->requestAction('POST', 'UserController@postLogin');

        $idProject = 1;

        $this->requestAction('GET', 'CompanyMessageController@createMessage', array($idProject));
        $this->assertViewHas('project');
        $this->assertViewHas('backUrl');
        $this->assertViewHas('volunteers');
        $this->assertViewHas('action');

    }

    public function testSendMessageErrorSubject()
    {

        $this->flushSession();


        $credentials = array(
            'email' => 'xeilaale@gmail.com',
            'password' => 'xeilaale1',
            'csrf_token' => Session::getToken()
        );


        //añadimos la solicitud de un voluntario

        $this->withInput($credentials)
            ->requestAction('POST', 'UserController@postLogin');

        $idProject = 1;

        $this->requestAction('GET', 'CompanyMessageController@createMessage', array($idProject));


        $messageData = array(
            'type' => 'volunteer',
            'textBox' => 'Esto es un mensaje.',

        );

        $this->withInput($messageData)->requestAction('POST', 'CompanyMessageController@sendMessage');
        $this->assertRedirectedTo(URL::to('company/message/sendMessage/'));
        $this->assertSessionHasErrors('subject');

    }

}