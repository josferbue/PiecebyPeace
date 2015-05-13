<?php

class CompanyApplicationControllerTest extends BaseControllerTestCase
{


    public function testFindOurAnsweredApplicationsErrorNotAuthenticate()
    {
        $this->flushSession();


        $this->requestAction('GET', 'CompanyApplicationController@findOurAnsweredApplications');
        $this->assertRedirectedTo('/');

    }

    public function testFindOurPendingApplicationsErrorNotAuthenticate()
    {
        $this->flushSession();


        $this->requestAction('GET', 'CompanyApplicationController@findOurPendingApplications');
        $this->assertRedirectedTo('/');
    }

    public function testFindOurAnsweredApplicationsResponseOk()
    {
        $this->flushSession();


        $credentials = array(
            'email' => 'xeilaale@gmail.com',
            'password' => 'xeilaale1',
            'csrf_token' => Session::getToken()
        );


        $this->withInput($credentials)
            ->requestAction('POST', 'UserController@postLogin');


        $this->requestAction('GET', 'CompanyApplicationController@findOurAnsweredApplications');
        $this->assertResponseOk();
        $this->assertViewHas('applications');
        $this->assertViewHas('backUrl');
        $this->assertViewHas('title');
    }

    public function testFindOurPendingApplicationsResponseOk()
    {
        $this->flushSession();


        $credentials = array(
            'email' => 'xeilaale@gmail.com',
            'password' => 'xeilaale1',
            'csrf_token' => Session::getToken()
        );


        $this->withInput($credentials)
            ->requestAction('POST', 'UserController@postLogin');


        $this->requestAction('GET', 'CompanyApplicationController@findOurPendingApplications');
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

        $this->requestAction('GET', 'CompanyApplicationController@listApplicationsInProject', array($idProject, 'pending'));
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
            'email' => 'xeilaale@gmail.com',
            'password' => 'xeilaale1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput($credentials)
            ->requestAction('POST', 'UserController@postLogin');

        $this->requestAction('GET', 'CompanyApplicationController@listApplicationsInProject', array($idProject, 'pending'));
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
        $this->requestAction('GET', 'CompanyApplicationController@viewApplication', array($idApplication));
        $this->assertRedirectedTo('/');


    }


}