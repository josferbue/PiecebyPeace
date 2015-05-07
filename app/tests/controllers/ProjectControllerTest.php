<?php

class ProjectControllerTest extends BaseControllerTestCase {

    // List of all VolunteerProjects

    public function testListAllVolunteerProjectsResponse()
    {
        $this->flushSession();

        $this->requestAction('GET', 'ProjectController@getVolunteerProjects');
        $this->assertResponseOk();
    }

    public function testListAllVolunteerVariables()
    {
        $this->flushSession();

        $this->requestAction('GET', 'ProjectController@getVolunteerProjects');
        $this->assertViewHas('categories');
        $this->assertViewHas('locations');
    }

      public function testFilterVolunteerProjects()
    {


        $data = array(
            'category'                      => 2,
            'city'                          => 'Sevilla',
            'startDate'                     =>  \Carbon\Carbon::createFromDate(2015,4,8)->toDateTimeString(),
            'finishDate'                    =>  \Carbon\Carbon::createFromDate(2016,8,23)->toDateTimeString(),

        );

        //ya que la variable se pilla de la sesion en el controlador debemos hacer esto aqui
        $projects = Project::whereNull('company_id')->paginate(4);
        $categories = Category::all();

        $locationVolunteerProjects = array();

        foreach ($projects as $project) {
            $countryActual = $project->country;
            if (array_key_exists($countryActual, $locationVolunteerProjects)) {
                if (!in_array($project->city, $locationVolunteerProjects[$countryActual])) {
                    $locationVolunteerProjects[$countryActual][] = $project->city;
                }
            } else {
                $locationVolunteerProjects[$countryActual] [] = $project->city;
            }
        }

        Session::put('categories', $categories);
        Session::put('locations', $locationVolunteerProjects);

        $this->withInput($data)->requestAction('GET', 'ProjectController@findVolunteerProjects');


        $this->assertResponseOk();
        $this->assertViewHas('categories');
        $this->assertViewHas('locations');
        $this->assertViewHas('projects');
        $this->assertViewHas('emptyProjects');
    }

    public function testViewVolunteerProject()
    {

        $this->requestAction('GET', 'ProjectController@viewVolunteerProject',array(1));

        $this->assertResponseOk();
        $this->assertViewHas('availableVolunteers');
        $this->assertViewHas('project');
        $this->assertViewHas('categories');
        $this->assertViewHas('isCsrProject');
        $this->assertViewHas('canApply');
        $this->assertViewHas('backUrl');
    }
    // List of all CsrProjects

    public function testListAllCsrProjectsResponse()
    {
        $this->flushSession();

        $this->requestAction('GET', 'ProjectController@getCsrProjects');
        $this->assertResponseOk();
    }

    public function testListAllCsrVariables()
    {
        $this->flushSession();

        $this->requestAction('GET', 'ProjectController@getCsrProjects');
        $this->assertViewHas('categories');
        $this->assertViewHas('locations');
    }

    public function testFilterCsrProjects()
    {


        $data = array(
            'category'                      => 2,
            'city'                          => 'Sevilla',
            'startDate'                     =>  \Carbon\Carbon::createFromDate(2015,4,8)->toDateTimeString(),
            'finishDate'                    =>  \Carbon\Carbon::createFromDate(2016,8,23)->toDateTimeString(),

        );

        $projects = Project::whereNull('ngo_id')->paginate(4);
        $categories = Category::all();

        //esto es un mapa que tendra como clave los county y valores las ciudades sin repeticion
        $locationCsrProjects = array();

        foreach ($projects as $project) {
            $countryActual = $project->country;
            if (array_key_exists($countryActual, $locationCsrProjects)) {
                //si ya existe la ciudad no la volvemos a poner
                if (!in_array($project->city, $locationCsrProjects[$countryActual])) {
                    //con esto no pisamos el value lo añadimos al final
                    $locationCsrProjects[$countryActual][] = $project->city;
                }
            } else {
                $locationCsrProjects[$countryActual] [] = $project->city;

            }
        }

        Session::put('categories', $categories);
        Session::put('locations', $locationCsrProjects);


        $this->withInput($data)->requestAction('GET', 'ProjectController@findCsrProjects');


        $this->assertResponseOk();
        $this->assertViewHas('categories');
        $this->assertViewHas('locations');
        $this->assertViewHas('projects');
        $this->assertViewHas('emptyProjects');
    }
    public function testViewCsrProject()
    {

        $this->requestAction('GET', 'ProjectController@viewCsrProject',array(2));

        $this->assertResponseOk();
        $this->assertViewHas('availableVolunteers');
        $this->assertViewHas('project');
        $this->assertViewHas('categories');
        $this->assertViewHas('isCsrProject');
        $this->assertViewHas('canApply');
        $this->assertViewHas('backUrl');
    }
}
