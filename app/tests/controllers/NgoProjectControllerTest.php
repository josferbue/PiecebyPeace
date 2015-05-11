<?php

class NgoProjectControllerTest extends BaseControllerTestCase
{

    public function testListNGOVolunteerProjectResponse()
    {
        $this->flushSession();
        $credentials = array(
            'email' => 'eat@gmail.com',
            'password' => 'eat1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput($credentials)
            ->requestAction('POST', 'UserController@postLogin');

        $this->requestAction('GET', 'NgoProjectController@findMyVolunteersProjects');
        $this->assertResponseOk();
    }

    public function testListNGOVolunteerProjectNotAuthenticated()
    {
        $this->flushSession();

        $this->requestAction('GET', 'NgoProjectController@findMyVolunteersProjects');
        $this->assertRedirectedTo('/');
    }

    public function testListNGOVolunteerProjectAuthenticatedAsACompany()
    {
        $this->flushSession();

        // Login in as company1
        $credentials = array(
            'email' => 'company@company1.com',
            'password' => 'company1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput($credentials)
            ->requestAction('POST', 'UserController@postLogin');

        $this->requestAction('GET', 'NgoProjectController@findMyVolunteersProjects');
        $this->assertRedirectedTo('/');
    }

    public function testListNGOVolunteerProjectVariables()
    {
        $this->flushSession();

            $credentials = array(
                'email' => 'eat@gmail.com',
                'password' => 'eat1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput($credentials)
            ->requestAction('POST', 'UserController@postLogin');

        $this->requestAction('GET', 'NgoProjectController@findMyVolunteersProjects');
        $this->assertViewHas('viewNgoMyProjects');
        $this->assertViewHas('projects');
        $this->assertViewHas('emptyProjects');

    }


    // Creation of a new Volunteer project

    public function testCreateVolunteerProjectResponse()
    {
        $this->flushSession();


        $credentials = array(
            'email' => 'eat@gmail.com',
            'password' => 'eat1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput($credentials)
            ->requestAction('POST', 'UserController@postLogin');

        $this->requestAction('GET', 'NgoProjectController@createVolunteerProject');
        $this->assertResponseOk();
    }


    public function testCreateVolunteerProjectRequiredField()
    {
        $this->flushSession();

        $credentials = array(
            'email' => 'eat@gmail.com',
            'password' => 'eat1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput($credentials)
            ->requestAction('POST', 'UserController@postLogin');

        $this->requestAction('GET', 'NgoProjectController@createVolunteerProject');

        $projectData = array(
//            'name'                          => 'ngo  3',
            'address' => 'calle liberty',
            'city' => 'Sevilla',
            'zipCode' => '41930',
            'country' => 'España',
            'maxVolunteers' => 20,
            'description' => 'Description volunteer project 3',
            'startDate' => \Carbon\Carbon::createFromDate(2015, 7, 23)->toDateTimeString(),
            'finishDate' => \Carbon\Carbon::createFromDate(2015, 8, 23)->toDateTimeString(),
            'categories' => array(2),
        );

        $this->withInput($projectData)->requestAction('POST', 'NgoProjectController@saveVolunteerProject');
        $this->assertRedirectedTo(URL::to('ngo/project/createVolunteerProject'));
        $this->assertSessionHasErrors('name');
    }

    public function testCreateVolunteerProjectNotEnoughLength()
    {
        $this->flushSession();


        $credentials = array(
            'email' => 'eat@gmail.com',
            'password' => 'eat1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput($credentials)
            ->requestAction('POST', 'UserController@postLogin');

        $this->requestAction('GET', 'NgoProjectController@createVolunteerProject');

        $projectData = array(
            'name' => 'ng',
            'address' => 'calle liberty',
            'city' => 'Sevilla',
            'zipCode' => '41930',
            'country' => 'España',
            'maxVolunteers' => 20,
            'description' => 'Description volunteer project 3',
            'startDate' => \Carbon\Carbon::createFromDate(2015, 7, 23)->toDateTimeString(),
            'finishDate' => \Carbon\Carbon::createFromDate(2015, 8, 23)->toDateTimeString(),
            'categories' => array(2),
        );

        $this->withInput($projectData)->requestAction('POST', 'NgoProjectController@saveVolunteerProject');
        $this->assertRedirectedTo(URL::to('ngo/project/createVolunteerProject'));
        $this->assertSessionHasErrors('name');

    }

    public function testCreateVolunteerProjectImageFieldIsNotAnImage()
    {
        $this->flushSession();

        $credentials = array(
            'email' => 'eat@gmail.com',
            'password' => 'eat1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput($credentials)
            ->requestAction('POST', 'UserController@postLogin');

        $this->requestAction('GET', 'NgoProjectController@createVolunteerProject');

        $projectData = array(
            'name' => 'ngo  3',
            'address' => 'calle liberty',
            'city' => 'Sevilla',
            'zipCode' => '41930',
            'country' => 'España',
            'maxVolunteers' => 20,
            'description' => 'Description volunteer project 3',
            'startDate' => \Carbon\Carbon::createFromDate(2015, 7, 23)->toDateTimeString(),
            'finishDate' => \Carbon\Carbon::createFromDate(2015, 8, 23)->toDateTimeString(),
            'categories' => array(2),
            'image' => 'image'
        );

        $this->withInput($projectData)->requestAction('POST', 'NgoProjectController@saveVolunteerProject');
        $this->assertRedirectedTo(URL::to('ngo/project/createVolunteerProject'));
        $this->assertSessionHasErrors('image');
    }

    public function testCreateVolunteerProjectOK()
    {
        $this->flushSession();


        $credentials = array(
            'email' => 'eat@gmail.com',
            'password' => 'eat1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput($credentials)
            ->requestAction('POST', 'UserController@postLogin');

        $this->requestAction('GET', 'NgoProjectController@createVolunteerProject');

        $projectData = array(
            'name' => 'ngo  3',
            'address' => 'calle liberty',
            'city' => 'Sevilla',
            'zipCode' => '41930',
            'country' => 'España',
            'maxVolunteers' => 20,
            'description' => 'Description volunteer project 3',
            'startDate' => \Carbon\Carbon::createFromDate(2016, 7, 23)->toDateTimeString(),
            'finishDate' => \Carbon\Carbon::createFromDate(2017, 8, 23)->toDateTimeString(),
            'categories' => array(2),
        );

        $this->withInput($projectData)->requestAction('POST', 'NgoProjectController@saveVolunteerProject');
        $this->assertRedirectedTo(URL::to('ngo/project/myVolunteersProjects'));

        $this->assertSessionHas("success");

    }

    public function testEditGetVolunteerProjectCompanyError()
    {

        $this->flushSession();

        $credentials = array(
            'email' => 'eat@gmail.com',
            'password' => 'eat1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput($credentials)
            ->requestAction('POST', 'UserController@postLogin');

        $this->requestAction('GET', 'NgoProjectController@createVolunteerProject');

        $projectData = array(
            'name' => 'ngo  3',
            'address' => 'calle liberty',
            'city' => 'Sevilla',
            'zipCode' => '41930',
            'country' => 'España',
            'maxVolunteers' => 20,
            'description' => 'Description volunteer project 3',
            'startDate' => \Carbon\Carbon::createFromDate(2016, 7, 23)->toDateTimeString(),
            'finishDate' => \Carbon\Carbon::createFromDate(2017, 8, 23)->toDateTimeString(),
            'categories' => array(2),
        );

        $this->withInput($projectData)->requestAction('POST', 'NgoProjectController@saveVolunteerProject');

        $this->flushSession();
        $credentials2 = array(
            'email' => 'xeilaale@gmail.com',
            'password' => 'xeilaale1',
            'csrf_token' => Session::getToken()
        );
        $this->withInput($credentials2)
            ->requestAction('POST', 'UserController@postLogin');
        $idProject = Project::where('name', '=', 'ngo  3')->first()->id;

        $this->requestAction('GET', 'NgoProjectController@editGetVolunteerProject', array($idProject));

        $this->assertRedirectedTo(URL::to('/'));



    }

    public function testEditGetVolunteerProjectOK()
    {

        $this->flushSession();


        $credentials = array(
            'email' => 'eat@gmail.com',
            'password' => 'eat1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput($credentials)
            ->requestAction('POST', 'UserController@postLogin');

        $this->requestAction('GET', 'NgoProjectController@createVolunteerProject');

        $projectData = array(
            'name' => 'ngo  3',
            'address' => 'calle liberty',
            'city' => 'Sevilla',
            'zipCode' => '41930',
            'country' => 'España',
            'maxVolunteers' => 20,
            'description' => 'Description volunteer project 3',
            'startDate' => \Carbon\Carbon::createFromDate(2016, 7, 23)->toDateTimeString(),
            'finishDate' => \Carbon\Carbon::createFromDate(2017, 8, 23)->toDateTimeString(),
            'categories' => array(2),
        );

        $this->withInput($projectData)->requestAction('POST', 'NgoProjectController@saveVolunteerProject');


        $project = Project::where('name', '=', 'ngo  3')->first();
        $project->volunteers;
        $project->categories;
        $project->applications;//se cargan las relaciones ya que el get del controlador las carga


        $this->requestAction('GET', 'NgoProjectController@editGetVolunteerProject', array($project->id));
        $this->assertViewHas('project', $project);


    }
    public function testEditSaveVolunteerProjectErrorAuthCompany()
    {

        $this->flushSession();


        $credentials = array(
            'email' => 'eat@gmail.com',
            'password' => 'eat1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput($credentials)
            ->requestAction('POST', 'UserController@postLogin');

        $this->requestAction('GET', 'NgoProjectController@createVolunteerProject');

        $projectData = array(
            'name' => 'ngo  3',
            'address' => 'calle liberty',
            'city' => 'Sevilla',
            'zipCode' => '41930',
            'country' => 'España',
            'maxVolunteers' => 20,
            'description' => 'Description volunteer project 3',
            'startDate' => \Carbon\Carbon::createFromDate(2016, 7, 23)->toDateTimeString(),
            'finishDate' => \Carbon\Carbon::createFromDate(2017, 8, 23)->toDateTimeString(),
            'categories' => array(2),
        );

        $this->withInput($projectData)->requestAction('POST', 'NgoProjectController@saveVolunteerProject');


        $project = Project::where('name', '=', 'ngo  3')->first();

        $projectDataEdit = array(
            'name' => 'EditadoNGO·',
            'address' => 'calle libertyEditada',
            'city' => 'Madrid',
            'zipCode' => '41940',
            'country' => 'España',
            'maxVolunteers' => 10,
            'description' => 'Description volunteer project 3 editado',
            'startDate' => \Carbon\Carbon::createFromDate(2015, 7, 23)->toDateTimeString(),
            'finishDate' => \Carbon\Carbon::createFromDate(2017, 8, 23)->toDateTimeString(),
            'categories' => array(1,2),
        );

        $this->flushSession();

        $credentials2 = array(
            'email' => 'xeilaale@gmail.com',
            'password' => 'xeilaale1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput($credentials2)
            ->requestAction('POST', 'UserController@postLogin');

        $this->withInput($projectDataEdit)->requestAction('POST', 'NgoProjectController@editSaveVolunteerProject', array($project->id));

        $this->assertRedirectedTo("/");


    }

    public function testEditSaveVolunteerProjectOK()
    {

        $this->flushSession();


        $credentials = array(
            'email' => 'eat@gmail.com',
            'password' => 'eat1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput($credentials)
            ->requestAction('POST', 'UserController@postLogin');

        $this->requestAction('GET', 'NgoProjectController@createVolunteerProject');

        $projectData = array(
            'name' => 'ngo  3',
            'address' => 'calle liberty',
            'city' => 'Sevilla',
            'zipCode' => '41930',
            'country' => 'España',
            'maxVolunteers' => 20,
            'description' => 'Description volunteer project 3',
            'startDate' => \Carbon\Carbon::createFromDate(2016, 7, 23)->toDateTimeString(),
            'finishDate' => \Carbon\Carbon::createFromDate(2017, 8, 23)->toDateTimeString(),
            'categories' => array(2),
        );

        $this->withInput($projectData)->requestAction('POST', 'NgoProjectController@saveVolunteerProject');


        $project = Project::where('name', '=', 'ngo  3')->first();

        $projectDataEdit = array(
            'name' => 'EditadoNGO·',
            'address' => 'calle libertyEditada',
            'city' => 'Madrid',
            'zipCode' => '41940',
            'country' => 'España',
            'maxVolunteers' => 10,
            'description' => 'Description volunteer project 3 editado',
            'startDate' => \Carbon\Carbon::createFromDate(2015, 7, 23)->toDateTimeString(),
            'finishDate' => \Carbon\Carbon::createFromDate(2017, 8, 23)->toDateTimeString(),
            'categories' => array(1,2),
        );


        $this->withInput($projectDataEdit)->requestAction('POST', 'NgoProjectController@editSaveVolunteerProject', array($project->id));

        $this->assertRedirectedTo("ngo/project/myVolunteersProjects/",array("success"));



    }
    public function testDeleteVolunteerProjectErrorNotHisProject()
    {

        $this->flushSession();

        $credentials = array(
            'email' => 'eat@gmail.com',
            'password' => 'eat1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput($credentials)
            ->requestAction('POST', 'UserController@postLogin');

        $this->requestAction('GET', 'NgoProjectController@createVolunteerProject');

        $projectData = array(
            'name' => 'ngo  3',
            'address' => 'calle liberty',
            'city' => 'Sevilla',
            'zipCode' => '41930',
            'country' => 'España',
            'maxVolunteers' => 20,
            'description' => 'Description volunteer project 3',
            'startDate' => \Carbon\Carbon::createFromDate(2016, 7, 23)->toDateTimeString(),
            'finishDate' => \Carbon\Carbon::createFromDate(2017, 8, 23)->toDateTimeString(),
            'categories' => array(2),
        );

        $this->withInput($projectData)->requestAction('POST', 'NgoProjectController@saveVolunteerProject');


        $project = Project::where('name', '=', 'ngo  3')->first();

        $credentials2 = array(
            'email' => 'steps@gmail.com',
            'password' => 'steps1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput($credentials2)
            ->requestAction('POST', 'UserController@postLogin');




        $this->requestAction('GET', 'NgoProjectController@deleteVolunteerProject', array($project->id));

        $this->assertRedirectedTo("project/view/".$project->id,array("error"));

    }
    public function testDeleteVolunteerProjectOK()
    {

        $this->flushSession();

        $credentials = array(
            'email' => 'eat@gmail.com',
            'password' => 'eat1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput($credentials)
            ->requestAction('POST', 'UserController@postLogin');

        $this->requestAction('GET', 'NgoProjectController@createVolunteerProject');

        $projectData = array(
            'name' => 'ngo  3',
            'address' => 'calle liberty',
            'city' => 'Sevilla',
            'zipCode' => '41930',
            'country' => 'España',
            'maxVolunteers' => 20,
            'description' => 'Description volunteer project 3',
            'startDate' => \Carbon\Carbon::createFromDate(2016, 7, 23)->toDateTimeString(),
            'finishDate' => \Carbon\Carbon::createFromDate(2017, 8, 23)->toDateTimeString(),
            'categories' => array(2),
        );

        $this->withInput($projectData)->requestAction('POST', 'NgoProjectController@saveVolunteerProject');


        $project = Project::where('name', '=', 'ngo  3')->first();


        $this->requestAction('GET', 'NgoProjectController@deleteVolunteerProject', array($project->id));

        $this->assertRedirectedTo("ngo/project/myVolunteersProjects",array("success"));



    }

}
