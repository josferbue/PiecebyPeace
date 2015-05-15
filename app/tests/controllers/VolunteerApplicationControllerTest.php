<?php

class VolunteerApplicationControllerTest extends BaseControllerTestCase
{


    public function testFindMyApplicationsCsrErrorNotAuthenticate()
    {
        $this->flushSession();


        $this->requestAction('GET', 'VolunteerApplicationController@findMyApplicationsCsr');
        $this->assertRedirectedTo('/');

    }

    public function testFindMyApplicationsVolunteerErrorNotAuthenticate()
    {
        $this->flushSession();


        $this->requestAction('GET', 'VolunteerApplicationController@findMyApplicationsVolunteer');
        $this->assertRedirectedTo('/');
    }

    public function testFindMyApplicationsCsrResponseOk()
    {
        $this->flushSession();


        $credentials = array(
            'email' => 'juan@gmail.com',
            'password' => 'juan1',
            'csrf_token' => Session::getToken()
        );


        $this->withInput($credentials)
            ->requestAction('POST', 'UserController@postLogin');


        $this->requestAction('GET', 'VolunteerApplicationController@findMyApplicationsCsr');
        $this->assertResponseOk();
    }

    public function testFindMyApplicationsVolunteerResponseOk()
    {
        $this->flushSession();


        $credentials = array(
            'email' => 'juan@gmail.com',
            'password' => 'juan1',
            'csrf_token' => Session::getToken()
        );


        $this->withInput($credentials)
            ->requestAction('POST', 'UserController@postLogin');


        $this->requestAction('GET', 'VolunteerApplicationController@findMyApplicationsVolunteer');
        $this->assertResponseOk();
    }


    public function testCreateApplicationResponseErrorNotAuthenticated()
    {
        $this->flushSession();


        $idProject = 2;
        $this->requestAction('GET', 'VolunteerApplicationController@createApplication', array($idProject));
        $this->assertRedirectedTo('/');
    }

    public function testCreateApplicationResponseOk()
    {
        $this->flushSession();


        $credentials = array(
            'email' => 'juan@gmail.com',
            'password' => 'juan1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput($credentials)
            ->requestAction('POST', 'UserController@postLogin');

        $idProject = 2;
        $this->requestAction('GET', 'VolunteerApplicationController@createApplication', array($idProject));
        $this->assertResponseOk();
    }


    public function testSaveApplicationErrorProjectApplyYet()
    {
        $this->flushSession();

        $credentials = array(
            'email' => 'raquel@gmail.com',
            'password' => 'raquel1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput($credentials)
            ->requestAction('POST', 'UserController@postLogin');

        $idProject = 1;
        $this->requestAction('GET', 'VolunteerApplicationController@createApplication', array($idProject));

        $applicationData = array(
            'comments' => 'Esto es una solicitud',
        );

        $this->withInput($applicationData)->requestAction('POST', 'VolunteerApplicationController@saveApplication', array($idProject));
        $this->assertRedirectedTo(URL::to('project/view/' . $idProject), array("error"));

    }

    public function testSaveApplicationOK()
    {

        $this->flushSession();

        $credentials = array(
            'email' => 'maria@gmail.com',
            'password' => 'maria1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput($credentials)
            ->requestAction('POST', 'UserController@postLogin');

        $idProject = 9;
        $this->requestAction('GET', 'VolunteerApplicationController@createApplication', array($idProject));

        $applicationData = array(
            'comments' => 'Esto es una solicitud',
        );

        $this->withInput($applicationData)->requestAction('POST', 'VolunteerApplicationController@saveApplication', array($idProject));
        $this->assertRedirectedTo(URL::to('projectCsr/view/' . $idProject), array("success"));

    }

    public function testCancelApplicationErrorAuthenticate()
    {

        $this->flushSession();

        $credentials = array(
            'email' => 'maria@gmail.com',
            'password' => 'maria1',
            'csrf_token' => Session::getToken()
        );
        $this->withInput($credentials)
            ->requestAction('POST', 'UserController@postLogin');
        $idVolunteer = Volunteer::where('user_id', '=', Auth::id())->first()->id;

        $idProject = 9;
        $this->requestAction('GET', 'VolunteerApplicationController@createApplication', array($idProject));

        $applicationData = array(
            'comments' => 'Esto es una solicitud',
        );

        $this->withInput($applicationData)->requestAction('POST', 'VolunteerApplicationController@saveApplication', array($idProject));

        $idApplication = Application::Where('project_id', '=', $idProject)->where('volunteer_id', '=', $idVolunteer)->first()->id;

        $this->flushSession();

        $credentials = array(
            'email' => 'jose@gmail.com',
            'password' => 'jose1',
            'csrf_token' => Session::getToken()
        );
        $this->withInput($credentials)
            ->requestAction('POST', 'UserController@postLogin');

        $this->requestAction('GET', 'VolunteerApplicationController@cancelApplication', array($idApplication));
        $this->assertRedirectedTo('/', array('error'));
    }

    public function testCancelApplicationOK()
    {

        $this->flushSession();

        $credentials = array(
            'email' => 'maria@gmail.com',
            'password' => 'maria1',
            'csrf_token' => Session::getToken()
        );
        $this->withInput($credentials)
            ->requestAction('POST', 'UserController@postLogin');
        $idVolunteer = Volunteer::where('user_id', '=', Auth::id())->first()->id;

        $idProject = 9;
        $this->requestAction('GET', 'VolunteerApplicationController@createApplication', array($idProject));

        $applicationData = array(
            'comments' => 'Esto es una solicitud',
        );

        $this->withInput($applicationData)->requestAction('POST', 'VolunteerApplicationController@saveApplication', array($idProject));


        $idApplication = Application::Where('project_id', '=', $idProject)->where('volunteer_id', '=', $idVolunteer)->first()->id;
        $this->requestAction('GET', 'VolunteerApplicationController@cancelApplication', array($idApplication));
        $this->assertRedirectedTo('volunteer/application/Csr', array('success'));

    }

    public function testViewApplicationErrorAuthenticate()
    {

        $this->flushSession();

        $credentials = array(
            'email' => 'maria@gmail.com',
            'password' => 'maria1',
            'csrf_token' => Session::getToken()
        );
        $this->withInput($credentials)
            ->requestAction('POST', 'UserController@postLogin');
        $idVolunteer = Volunteer::where('user_id', '=', Auth::id())->first()->id;

        $idProject = 9;
        $this->requestAction('GET', 'VolunteerApplicationController@createApplication', array($idProject));

        $applicationData = array(
            'comments' => 'Esto es una solicitud',
        );

        $this->withInput($applicationData)->requestAction('POST', 'VolunteerApplicationController@saveApplication', array($idProject));


        $this->flushSession();

        $credentials = array(
            'email' => 'jose@gmail.com',
            'password' => 'jose1',
            'csrf_token' => Session::getToken()
        );
        $this->withInput($credentials)
            ->requestAction('POST', 'UserController@postLogin');

        $idApplication = Application::Where('project_id', '=', $idProject)->where('volunteer_id', '=', $idVolunteer)->first()->id;
        $this->requestAction('GET', 'VolunteerApplicationController@viewApplication', array($idApplication));
        $this->assertRedirectedTo('/', array('error'));


    }

}