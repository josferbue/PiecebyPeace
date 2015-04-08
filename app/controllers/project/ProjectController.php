<?php

/**
 * Created by PhpStorm.
 * User: Alejandro
 * Date: 08/04/2015
 * Time: 1:39
 */
class ProjectController extends BaseController
{
    protected $locationVolunteerProjects;
    protected $categoriesVolunteerProjects;

    public function __construct()
    {
        parent::__construct();
    }

    Public function getProjects()
    {
        $projects = Project::whereNull('company_id')->get();
        $categoriesVolunteerProjects = Category::all();

        //esto es un mapa que tendra como clave los county y valores las ciudades sin repeticion
        $locationVolunteerProjects = array();

        foreach ($projects as $project) {
            $countryActual = $project->country;
            if (array_key_exists($countryActual, $locationVolunteerProjects)) {
                //si ya existe la ciudad no la volvemos a poner
                if (!in_array($project->city, $locationVolunteerProjects->$countryActual)) {
                    //con esto no pisamos el value lo añadimos al final
                    $locationVolunteerProjects[$countryActual][] = $project->city;
                }
            } else {
                $locationVolunteerProjects[$countryActual] [] = $project->city;

            }
        }

        Session::put('categories', $categoriesVolunteerProjects);
        Session::put('locations', $locationVolunteerProjects);


        $data = array(

            'categories' => $categoriesVolunteerProjects,
            'locations' => $locationVolunteerProjects,
            'projects' => ''
        );

        Return View::make('site/project/list')->with($data);

    }

    Public function findProjects()
    {


        $startDate = Input::get('startDate');
        $finishDate = Input::get('finishDate');
        $city = Input::get('city');
        $categoryString = Input::get('category');
        $res = array();
//        ->where('category', '=', $category)
        $category = Category::where('name', '=', $categoryString)->first();

        $projectsAux = Project::whereNull('company_id')->where('city', '=', $city)->where('startDate', '>', $startDate)
            ->where('finishDate', '<', $finishDate)->get();

        $projects = array();

        foreach ($projectsAux as $project) {
            $categoriesAux = $project->categories;
            //devuelve un Collection no un array por eso comprobamos de esta forma si esta contenido
            if ($categoriesAux->contains($category)) {
                $projects[] = $project;
            }
        }

        if (empty($projects)) {
            $projects = 'nothing';
        }
        $data = array(

            'categories' => Session::get('categories'),
            'locations' => Session::get('locations'),
            'projects' => $projects
        );
        Return View::make('site/project/list')->with($data);
    }

    public function viewProject($id){

        $project=Project::where('id', '=', $id)->get();
        $volunteers=$project->cooperates;
        $availableVolunteers= $project->maxVolunteers - sizeof($volunteers);

        $data = array(

            'availableVolunteers' => $availableVolunteers,
            'project' => $project
        );
        View::make('site/project/view')->with(data);


    }
}