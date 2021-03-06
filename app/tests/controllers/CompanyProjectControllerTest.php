<?php

class CompanyProjectControllerTest extends BaseControllerTestCase
{

    public function testListCompanyCsrProjectResponse()
    {
        $this->flushSession();


        $credentials = array(
            'email' => 'xeilaale@gmail.com',
            'password' => 'xeilaale1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput($credentials)
            ->requestAction('POST', 'UserController@postLogin');

        $this->requestAction('GET', 'CompanyProjectController@findMyCsrProjects');
        $this->assertResponseOk();
    }

    public function testListCompanyCsrProjectNotAuthenticated()
    {
        $this->flushSession();

        $this->requestAction('GET', 'CompanyProjectController@findMyCsrProjects');
        $this->assertRedirectedTo('/');
    }

    public function testListCompanyCsrProjectAuthenticatedAsANgo()
    {
        $this->flushSession();

        $credentials = array(
            'email' => 'steps@gmail.com',
            'password' => 'steps1',
            'csrf_token' => Session::getToken()
        );
        $this->withInput($credentials)
            ->requestAction('POST', 'UserController@postLogin');

        $this->requestAction('GET', 'CompanyProjectController@findMyCsrProjects');
        $this->assertRedirectedTo('/');
    }

    public function testListCompanyCsrProjectVariables()
    {
        $this->flushSession();

        $credentials = array(
            'email' => 'xeilaale@gmail.com',
            'password' => 'xeilaale1',
            'csrf_token' => Session::getToken()
        );
        $this->withInput($credentials)
            ->requestAction('POST', 'UserController@postLogin');

        $this->requestAction('GET', 'CompanyProjectController@findMyCsrProjects');
        $this->assertViewHas('projects');
        $this->assertViewHas('emptyProjects');

    }


    // Creation of a new Volunteer project

    public function testCreateCsrProjectResponse()
    {
        $this->flushSession();

        $credentials = array(
            'email' => 'xeilaale@gmail.com',
            'password' => 'xeilaale1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput($credentials)
            ->requestAction('POST', 'UserController@postLogin');

        $this->requestAction('GET', 'CompanyProjectController@createCsrProject');
        $this->assertResponseOk();
    }


    public function testCreateCsrProjectRequiredField()
    {
        $this->flushSession();

        $credentials = array(
            'email' => 'xeilaale@gmail.com',
            'password' => 'xeilaale1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput($credentials)
            ->requestAction('POST', 'UserController@postLogin');

        $this->requestAction('GET', 'CompanyProjectController@createCsrProject');

        $projectData = array(
            'address' => 'calle liberty',
            'city' => 'Sevilla',
            'zipCode' => '41930',
            'country' => 'España',
            'maxVolunteers' => 20,
            'description' => 'Description csr project 3',
            'startDate' => \Carbon\Carbon::createFromDate(2015, 7, 23)->toDateTimeString(),
            'finishDate' => \Carbon\Carbon::createFromDate(2015, 8, 23)->toDateTimeString(),
            'categories' => array(1),
        );

        $this->withInput($projectData)->requestAction('POST', 'CompanyProjectController@saveCsrProject');
        $this->assertRedirectedTo(URL::to('company/project/createCsrProject'));
        $this->assertSessionHasErrors('name');
    }

    public function testCreateCsrProjectNotEnoughLength()
    {
        $this->flushSession();

        $credentials = array(
            'email' => 'xeilaale@gmail.com',
            'password' => 'xeilaale1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput($credentials)
            ->requestAction('POST', 'UserController@postLogin');

        $this->requestAction('GET', 'CompanyProjectController@createCsrProject');

        $projectData = array(
            'name' => 'cm',
            'address' => 'calle liberty',
            'city' => 'Sevilla',
            'zipCode' => '41930',
            'country' => 'España',
            'maxVolunteers' => 20,
            'description' => 'Description csr project 3',
            'startDate' => \Carbon\Carbon::createFromDate(2015, 7, 23)->toDateTimeString(),
            'finishDate' => \Carbon\Carbon::createFromDate(2015, 8, 23)->toDateTimeString(),
            'categories' => array(1),
        );

        $this->withInput($projectData)->requestAction('POST', 'CompanyProjectController@saveCsrProject');
        $this->assertRedirectedTo(URL::to('company/project/createCsrProject'));
        $this->assertSessionHasErrors('name');

    }

    public function testCreateCsrProjectImageFieldIsNotAnImage()
    {
        $this->flushSession();

        $credentials = array(
            'email' => 'xeilaale@gmail.com',
            'password' => 'xeilaale1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput($credentials)
            ->requestAction('POST', 'UserController@postLogin');

        $this->requestAction('GET', 'CompanyProjectController@createCsrProject');

        $projectData = array(
            'name' => 'companyProject',
            'address' => 'calle liberty',
            'city' => 'Sevilla',
            'zipCode' => '41930',
            'country' => 'España',
            'maxVolunteers' => 20,
            'description' => 'Description csr project 3',
            'startDate' => \Carbon\Carbon::createFromDate(2015, 7, 23)->toDateTimeString(),
            'finishDate' => \Carbon\Carbon::createFromDate(2015, 8, 23)->toDateTimeString(),
            'categories' => array(1),
            'image' => 'image'
        );

        $this->withInput($projectData)->requestAction('POST', 'CompanyProjectController@saveCsrProject');
        $this->assertRedirectedTo(URL::to('company/project/createCsrProject'));
        $this->assertSessionHasErrors('image');
    }

    public function testCreateCsrProjectOK()
    {
        $this->flushSession();

        $credentials = array(
            'email' => 'xeilaale@gmail.com',
            'password' => 'xeilaale1',
            'csrf_token' => Session::getToken()
        );
        $this->withInput($credentials)
            ->requestAction('POST', 'UserController@postLogin');

        $this->requestAction('GET', 'CompanyProjectController@createCsrProject');

        $projectData = array(
            'name' => 'companyProject',
            'address' => 'calle liberty',
            'city' => 'Sevilla',
            'zipCode' => '41930',
            'country' => 'España',
            'maxVolunteers' => 20,
            'description' => 'Description csr project 3',
            'startDate' => \Carbon\Carbon::createFromDate(2016, 7, 23)->toDateTimeString(),
            'finishDate' => \Carbon\Carbon::createFromDate(2017, 8, 23)->toDateTimeString(),
            'categories' => array(1),
        );

        $this->withInput($projectData)->requestAction('POST', 'CompanyProjectController@saveCsrProject');
        $this->assertRedirectedTo(URL::to('company/project/myCsrProjects'));

        $this->assertSessionHas("success");

    }


    public function testEditGetCsrProjectOK()
    {

        $this->flushSession();

        $credentials = array(
            'email' => 'xeilaale@gmail.com',
            'password' => 'xeilaale1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput($credentials)
            ->requestAction('POST', 'UserController@postLogin');

        $this->requestAction('GET', 'CompanyProjectController@createCsrProject');

        $projectData = array(
            'name' => 'company  3',
            'address' => 'calle liberty',
            'city' => 'Sevilla',
            'zipCode' => '41930',
            'country' => 'España',
            'maxVolunteers' => 20,
            'description' => 'Description csr project 3',
            'startDate' => \Carbon\Carbon::createFromDate(2016, 7, 23)->toDateTimeString(),
            'finishDate' => \Carbon\Carbon::createFromDate(2017, 8, 23)->toDateTimeString(),
            'categories' => array(2),
        );

        $this->withInput($projectData)->requestAction('POST', 'CompanyProjectController@saveCsrProject');


        $project = Project::where('name', '=', 'company  3')->first();
        $project->volunteers;
        $project->categories;
        $project->applications;//se cargan las relaciones ya que el get del controlador las carga


        $this->requestAction('GET', 'CompanyProjectController@editGetCsrProject', array($project->id));
        $this->assertViewHas('project', $project);


    }

    public function testEditSaveCsrProjectErrorAuthNgo()
    {

        $this->flushSession();


        $credentials = array(
            'email' => 'xeilaale@gmail.com',
            'password' => 'xeilaale1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput($credentials)
            ->requestAction('POST', 'UserController@postLogin');

        $this->requestAction('GET', 'CompanyProjectController@createCsrProject');

        $projectData = array(
            'name' => 'project Company 3',
            'address' => 'calle liberty',
            'city' => 'Sevilla',
            'zipCode' => '41930',
            'country' => 'España',
            'maxVolunteers' => 20,
            'description' => 'Description csr project 3',
            'startDate' => \Carbon\Carbon::createFromDate(2016, 7, 23)->toDateTimeString(),
            'finishDate' => \Carbon\Carbon::createFromDate(2017, 8, 23)->toDateTimeString(),
            'categories' => array(1,2),
        );

        $this->withInput($projectData)->requestAction('POST', 'CompanyProjectController@saveCsrProject');


        $project = Project::where('name', '=', 'project Company 3')->first();

        $projectDataEdit = array(
            'name' => 'EditadoComapany',
            'address' => 'calle libertyEditada',
            'city' => 'Madrid',
            'zipCode' => '41940',
            'country' => 'España',
            'maxVolunteers' => 10,
            'description' => 'Description csr project 3 editado',
            'startDate' => \Carbon\Carbon::createFromDate(2015, 7, 23)->toDateTimeString(),
            'finishDate' => \Carbon\Carbon::createFromDate(2017, 8, 23)->toDateTimeString(),
            'categories' => array(1, 2),
        );

        $this->flushSession();

        $credentials2 = array(
            'email' => 'steps@gmail.com',
            'password' => 'steps1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput($credentials2)
            ->requestAction('POST', 'UserController@postLogin');

        $this->withInput($projectDataEdit)->requestAction('POST', 'CompanyProjectController@editSaveCsrProject', array($project->id));

        $this->assertRedirectedTo("/");


    }

    public function testEditSaveCsrProjectOK()
    {

        $this->flushSession();

        $credentials = array(
            'email' => 'xeilaale@gmail.com',
            'password' => 'xeilaale1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput($credentials)
            ->requestAction('POST', 'UserController@postLogin');

        $this->requestAction('GET', 'CompanyProjectController@createCsrProject');

        $projectData = array(
            'name' => 'project Company 3',
            'address' => 'calle liberty',
            'city' => 'Sevilla',
            'zipCode' => '41930',
            'country' => 'España',
            'maxVolunteers' => 20,
            'description' => 'Description csr project 3',
            'startDate' => \Carbon\Carbon::createFromDate(2016, 7, 23)->toDateTimeString(),
            'finishDate' => \Carbon\Carbon::createFromDate(2017, 8, 23)->toDateTimeString(),
            'categories' => array(1,2),
        );

        $this->withInput($projectData)->requestAction('POST', 'CompanyProjectController@saveCsrProject');


        $project = Project::where('name', '=', 'project Company 3')->first();

        $projectDataEdit = array(
            'name' => 'EditadoComapany',
            'address' => 'calle libertyEditada',
            'city' => 'Madrid',
            'zipCode' => '41940',
            'country' => 'España',
            'maxVolunteers' => 10,
            'description' => 'Description csr project 3 editado',
            'startDate' => \Carbon\Carbon::createFromDate(2015, 7, 23)->toDateTimeString(),
            'finishDate' => \Carbon\Carbon::createFromDate(2017, 8, 23)->toDateTimeString(),
            'categories' => array(1, 2),
        );


        $this->withInput($projectDataEdit)->requestAction('POST', 'CompanyProjectController@editSaveCsrProject', array($project->id));

        $this->assertRedirectedTo("company/project/myCsrProjects/", array("success"));


    }

    public function testDeleteCsrProjectErrorNotHisProject()
    {

        $this->flushSession();

        $credentials = array(
            'email' => 'xeilaale@gmail.com',
            'password' => 'xeilaale1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput($credentials)
            ->requestAction('POST', 'UserController@postLogin');

        $this->requestAction('GET', 'CompanyProjectController@createCsrProject');

        $projectData = array(
            'name' => 'project Company 3',
            'address' => 'calle liberty',
            'city' => 'Sevilla',
            'zipCode' => '41930',
            'country' => 'España',
            'maxVolunteers' => 20,
            'description' => 'Description csr project 3',
            'startDate' => \Carbon\Carbon::createFromDate(2016, 7, 23)->toDateTimeString(),
            'finishDate' => \Carbon\Carbon::createFromDate(2017, 8, 23)->toDateTimeString(),
            'categories' => array(1,2),
        );

        $this->withInput($projectData)->requestAction('POST', 'CompanyProjectController@saveCsrProject');


        $project = Project::where('name', '=', 'project Company 3')->first();

        $credentials2 = array(
            'email' => 'xorysoft@gmail.com',
            'password' => 'xorysoft1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput($credentials2)
            ->requestAction('POST', 'UserController@postLogin');


        $this->requestAction('GET', 'CompanyProjectController@deleteCsrProject', array($project->id));

        $this->assertRedirectedTo("projectCsr/view/" . $project->id, array("error"));

    }

    public function testDeleteCsrProjectOK()
    {
        $this->flushSession();

        $credentials = array(
            'email' => 'xeilaale@gmail.com',
            'password' => 'xeilaale1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput($credentials)
            ->requestAction('POST', 'UserController@postLogin');

        $this->requestAction('GET', 'CompanyProjectController@createCsrProject');

        $projectData = array(
            'name' => 'project Company 3',
            'address' => 'calle liberty',
            'city' => 'Sevilla',
            'zipCode' => '41930',
            'country' => 'España',
            'maxVolunteers' => 20,
            'description' => 'Description csr project 3',
            'startDate' => \Carbon\Carbon::createFromDate(2016, 7, 23)->toDateTimeString(),
            'finishDate' => \Carbon\Carbon::createFromDate(2017, 8, 23)->toDateTimeString(),
            'categories' => array(1,2),
        );

        $this->withInput($projectData)->requestAction('POST', 'CompanyProjectController@saveCsrProject');


        $project = Project::where('name', '=', 'project Company 3')->first();


        $this->requestAction('GET', 'CompanyProjectController@deleteCsrProject', array($project->id));

        $this->assertRedirectedTo("company/project/myCsrProjects", array("success"));


    }
}


