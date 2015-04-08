<?php

/**
 * Created by PhpStorm.
 * User: Alejandro
 * Date: 08/04/2015
 * Time: 1:39
 */
class ProjectController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    Public function getProjects()
    {
        $projects = Project::whereNull('company_id')->get();
        $categories = Category::all();

        //esto es un mapa que tendra como clave los county y valores las ciudades sin repeticion
        $locations = array();

        foreach ($projects as $project) {
            $countryActual = $project->country;
            if (array_key_exists($countryActual, $locations)) {
                //si ya existe la ciudad no la volvemos a poner
                if (!in_array($project->city, $locations->$countryActual)) {
                    //con esto no pisamos el value lo añadimos al final
                    $locations[$countryActual][] = $project->city;
                }
            } else {
                $locations[$countryActual] [] = $project->city;

            }
        }
        $data = array(

            'categories' => $categories,
            'locations' => $locations
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

        $projects = DB::table('project')
            ->whereNull('company_id')->where('city', '=', $city)->where('startDate', '>', $startDate)
            ->where('finishDate', '<', $finishDate)->get();
        foreach ($projects as $project) {
            $categoriesAux=$project->categories;
            if (in_array($category, $project->categories)) {
                $res[] = $project;
            }


        }
        Return View::make('site/project/list')->with('projects', $res);
    }
}