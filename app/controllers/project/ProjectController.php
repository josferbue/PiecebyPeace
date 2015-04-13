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

    Public function getVolunteerProjects()
    {
        $projects = Project::whereNull('company_id')->paginate(4);
        $categories = Category::all();

        //esto es un mapa que tendra como clave los county y valores las ciudades sin repeticion
        $locationVolunteerProjects = array();

        foreach ($projects as $project) {
            $countryActual = $project->country;
            if (array_key_exists($countryActual, $locationVolunteerProjects)) {
                //si ya existe la ciudad no la volvemos a poner
                if (!in_array($project->city, $locationVolunteerProjects[$countryActual])) {
                    //con esto no pisamos el value lo añadimos al final
                    $locationVolunteerProjects[$countryActual][] = $project->city;
                }
            } else {
                $locationVolunteerProjects[$countryActual] [] = $project->city;

            }
        }

        Session::put('categories', $categories);
        Session::put('locations', $locationVolunteerProjects);


        $data = array(
            'categories' => $categories,
            'locations' => $locationVolunteerProjects,

        );

        Return View::make('site/project/list')->with($data);

    }

    Public function findVolunteerProjects()
    {

        $startDate = Input::get('startDate');
        $finishDate = Input::get('finishDate');
        $city = Input::get('city');

        $projects = Project::whereNull('company_id')->where('city', '=', $city)->where('startDate', '>', $startDate)
            ->where('finishDate', '<', $finishDate)->whereHas('categories', function ($q) {
                $q->where('category_id', 'like', Input::get('category'));
            })->paginate(4);


        $emptyProjects = false;
        if ($projects->getTotal()==0) {
            $emptyProjects = true;
        }
        //Transformamos el array en un paginator
        $data = array(
            'categories' => Session::get('categories'),
            'locations' => Session::get('locations'),
            'projects' => $projects,
            'emptyProjects' => $emptyProjects
        );
        Input::flash();
        Return View::make('site/project/list')->with($data);
    }

    public function viewVolunteerProject($id)
    {
        $backUrl = Session::get('backUrl');
        $user = Auth::user();
        $ngo = Ngo::where('user_id', '=', $user->id)->first();
        $project = Project::where('id', '=', $id)->first();
        $volunteers = $project->volunteers;
        $availableVolunteers = $project->maxVolunteers - sizeof($volunteers);
        $categories = '';
        for ($i = 0; $i < sizeof($project->categories); $i++) {
            $category = $project->categories[$i];
            if ($i == (sizeof($project->categories) - 1)) {
                $categories .= $category->name;
            } else {
                $categories .= $category->name . ', ';
            }
        }
        $data = array(

            'availableVolunteers' => $availableVolunteers,
            'project' => $project,
            'categories' => $categories,
            'backUrl' => $backUrl
        );

        //si se trata de un ngo y es su proyecto tendra boton para editar
        if (!is_null($ngo)) {
            if ($ngo->id == $project->ngo_id) {
                $data['editable'] = true;
            }

        }
        return View::make('site/project/view')->with($data);


    }
}