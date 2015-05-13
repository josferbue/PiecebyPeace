<?php

class NgoApplicationControllerTest extends BaseControllerTestCase
{


    public function testFindOurAnsweredApplicationsErrorNotAuthenticate()
    {
        $this->flushSession();


        $this->requestAction('GET', 'NgoApplicationController@findOurAnsweredApplications');
        $this->assertRedirectedTo('/');

    }

    public function testFindOurPendingApplicationsErrorNotAuthenticate()
    {
        $this->flushSession();


        $this->requestAction('GET', 'NgoApplicationController@findOurPendingApplications');
        $this->assertRedirectedTo('/');
    }

    public function testFindOurAnsweredApplicationsResponseOk()
    {
        $this->flushSession();


        $credentials = array(
            'email' => 'steps@gmail.com',
            'password' => 'steps1',
            'csrf_token' => Session::getToken()
        );


        $this->withInput($credentials)
            ->requestAction('POST', 'UserController@postLogin');


        $this->requestAction('GET', 'NgoApplicationController@findOurAnsweredApplications');
        $this->assertResponseOk();
        $this->assertViewHas('applications');
        $this->assertViewHas('backUrl');
        $this->assertViewHas('title');
    }

    public function testFindOurPendingApplicationsResponseOk()
    {
        $this->flushSession();


        $credentials = array(
            'email' => 'steps@gmail.com',
            'password' => 'steps1',
            'csrf_token' => Session::getToken()
        );


        $this->withInput($credentials)
            ->requestAction('POST', 'UserController@postLogin');


        $this->requestAction('GET', 'NgoApplicationController@findOurPendingApplications');
        $this->assertResponseOk();
        $this->assertViewHas('applications');
        $this->assertViewHas('backUrl');
        $this->assertViewHas('title');
        $this->assertViewHas('isPending');
    }

    public function testListApplicationsInProjectErrorAuthenticated()
    {

        //creamos una solicitud para luego listarla
        $this->flushSession();

        $credentials = array(
            'email' => 'maria@gmail.com',
            'password' => 'maria1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput($credentials)
            ->requestAction('POST', 'UserController@postLogin');

        $idProject = 8;
        $this->requestAction('GET', 'VolunteerApplicationController@createApplication', array($idProject));

        $applicationData = array(
            'comments' => 'Esto es una solicitud',
        );

        $this->withInput($applicationData)->requestAction('POST', 'VolunteerApplicationController@saveApplication', array($idProject));

        //listamos la solicitud
        $this->flushSession();

        $credentials = array(
            'email' => 'juan@gmail.com',
            'password' => 'juan1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput($credentials)
            ->requestAction('POST', 'UserController@postLogin');

        $this->requestAction('GET', 'NgoApplicationController@listApplicationsInProject', array($idProject, 'pending'));
        $this->assertRedirectedTo('/');

    }

    public function testListApplicationsInProjectOK()
    {

        //creamos una solicitud para luego listarla
        $this->flushSession();

        $credentials = array(
            'email' => 'maria@gmail.com',
            'password' => 'maria1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput($credentials)
            ->requestAction('POST', 'UserController@postLogin');

        $idProject = 8;
        $this->requestAction('GET', 'VolunteerApplicationController@createApplication', array($idProject));

        $applicationData = array(
            'comments' => 'Esto es una solicitud',
        );

        $this->withInput($applicationData)->requestAction('POST', 'VolunteerApplicationController@saveApplication', array($idProject));

        //listamos la solicitud
        $this->flushSession();

        $credentials = array(
            'email' => 'eat@gmail.com',
            'password' => 'eat1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput($credentials)
            ->requestAction('POST', 'UserController@postLogin');

        $this->requestAction('GET', 'NgoApplicationController@listApplicationsInProject', array($idProject, 'pending'));
        $this->assertResponseOk();
        $this->assertViewHas('applications');
        $this->assertViewHas('backUrl');
        $this->assertViewHas('title');

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
        $this->requestAction('GET', 'NgoApplicationController@viewApplication', array($idApplication));
        $this->assertRedirectedTo('/');


    }


}