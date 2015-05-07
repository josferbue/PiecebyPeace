<?php

class VolunteerProjectListViewsTest extends BaseControllerTestCase {


    public function testCreateResponse()
    {
        // Login in as ngo1
        $credentials = array(
            'email'=>'ngo1@ngo1.com',
            'password'=>'ngo1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput( $credentials )
            ->requestAction('POST', 'UserController@postLogin');

        $crawler = $this->client->request('GET', URL::to('ngo/project/createVolunteerProject'));

        $this->assertResponseOk();
    }

    public function testCreateResponseNotAuthenticated()
    {
        $crawler = $this->client->request('GET', URL::to('ngo/project/createVolunteerProject'));

        $this->assertRedirection( URL::to('/') );
    }

    public function testListVolunteerProjectResponse()
    {
        $crawler = $this->client->request('GET', URL::to('projects'));

        $this->assertTrue($this->client->getResponse()->isOk());
    }

    public function testVolunteerProject1Name()
    {

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

        $crawler = $this->client->request('GET', URL::to('projectsFilter?category=2&city=Sevilla&startDate=2015-04-06&finishDate=2016-04-07'));

        $this->assertCount(1, $crawler->filter('h3:contains("Project 1")'));
    }



    public function testVolunteerProjectNameLinkToDetails()
    {
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
        $crawler = $this->client->request('GET', URL::to('projectsFilter?category=2&city=Sevilla&startDate=2015-04-06&finishDate=2016-04-07'));

        $link = $crawler->selectLink('Project 1')->link();

        $url = $link->getUri();

        $this->assertEqualsUrlPath($url, 'project/view/2');
    }

    // List campaigns logged in as ngo1

    public function testListNGOVolunteerProjectResponse()
    {
        // Login in as ngo1
        $credentials = array(
            'email'=>'ngo1@ngo1.com',
            'password'=>'ngo1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput( $credentials )
            ->requestAction('POST', 'UserController@postLogin');

        $crawler = $this->client->request('GET', URL::to('ngo/project/myVolunteersProjects'));

        $this->assertTrue($this->client->getResponse()->isOk());
    }

    public function testListNGOVolunteerProjectResponseNotAuthenticated()
    {
        $crawler = $this->client->request('GET', URL::to('ngo/project/myVolunteersProjects'));

        $this->assertRedirection( URL::to('/') );
    }

    public function testNGOVolunteerProject1Name()
    {
        // Login in as ngo1
        $credentials = array(
            'email'=>'ngo1@ngo1.com',
            'password'=>'ngo1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput( $credentials )
            ->requestAction('POST', 'UserController@postLogin');

        $crawler = $this->client->request('GET', URL::to('ngo/project/myVolunteersProjects'));

        $this->assertCount(1, $crawler->filter('h3:contains("Project 1")'));
    }

    public function testNGOVolunteerProject1NameLinkToDetails()
    {
        // Login in as ngo1
        $credentials = array(
            'email'=>'ngo1@ngo1.com',
            'password'=>'ngo1',
            'csrf_token' => Session::getToken()
        );

        $this->withInput( $credentials )
            ->requestAction('POST', 'UserController@postLogin');

        $crawler = $this->client->request('GET', URL::to('ngo/project/myVolunteersProjects'));

        $link = $crawler->selectLink('Project 1')->link();

        $url = $link->getUri();

        $this->assertEqualsUrlPath($url, 'project/view/2');
    }


    public function testDetailsVolunteerProject1Response()
    {
        $crawler = $this->client->request('GET', URL::to('project/view/1'));

        $this->assertTrue($this->client->getResponse()->isOk());
    }
}