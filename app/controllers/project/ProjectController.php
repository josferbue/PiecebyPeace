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
    protected $project;

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

        $volunteer = Volunteer::where('user_id', '=', Auth::id())->first();
        $ngo = Ngo::where('user_id', '=', Auth::id())->first();
        //se usara para añadir boton de enviar mensajes
        $authVolunteerId = null;
        $authNgoId = null;
        $projectsOfVolunteer = new \Illuminate\Database\Eloquent\Collection;
        if ($volunteer != null) {
            $authVolunteerId = $volunteer->id;
            $projectsOfVolunteer = $volunteer->cooperates;
        } elseif ($ngo != null) {
            $authNgoId = $ngo->id;
        }

        $startDate = Input::get('startDate');
        $finishDate = Input::get('finishDate');
        $city = Input::get('city');

        $projects = Project::whereNull('company_id')->where('city', '=', $city)->where('startDate', '>', $startDate)
            ->where('finishDate', '<', $finishDate)->whereHas('categories', function ($q) {
                $q->where('category_id', 'like', Input::get('category'));
            })->paginate(4);


        $emptyProjects = false;
        if ($projects->getTotal() == 0) {
            $emptyProjects = true;
        }
        //Transformamos el array en un paginator
        $data = array(
            'categories' => Session::get('categories'),
            'locations' => Session::get('locations'),
            'projects' => $projects,
            'emptyProjects' => $emptyProjects,
            'projectsOfVolunteer' => $projectsOfVolunteer,
            'authNgoId' => $authNgoId,
            'authVolunteerId' => $authVolunteerId,

        );
        Input::flash();
        Return View::make('site/project/list')->with($data);
    }

    public function viewVolunteerProject($id)
    {
        $backUrl = Session::get('backUrl');
        if (strpos($backUrl, 'projectsFilter') !== false) {
            $backUrl = str_replace('Filter', '', $backUrl);
        }

        $ngo = Ngo::where('user_id', '=', Auth::id())->first();
        $isCsrProject = false;

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
            'isCsrProject' => $isCsrProject,
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

    Public function getCsrProjects()
    {
        $projects = Project::whereNull('ngo_id')->paginate(4);
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

        Return View::make('company/project/list')->with($data);

    }

    Public function findCsrProjects()
    {
        $volunteer = Volunteer::where('user_id', '=', Auth::id())->first();
        $company = Company::where('user_id', '=', Auth::id())->first();
        //se usara para añadir boton de enviar mensajes
        $authVolunteerId = null;
        $authCompanyId = null;

        $projectsOfVolunteer = new \Illuminate\Database\Eloquent\Collection;
        if ($volunteer != null) {
            $authVolunteerId = $volunteer->id;
            $projectsOfVolunteer = $volunteer->cooperates;

        } elseif ($company != null) {
            $authCompanyId = $company->id;
        }

        $startDate = Input::get('startDate');
        $finishDate = Input::get('finishDate');
        $city = Input::get('city');

        $projects = Project::whereNull('ngo_id')->where('city', '=', $city)->where('startDate', '>', $startDate)
            ->where('finishDate', '<', $finishDate)->whereHas('categories', function ($q) {
                $q->where('category_id', 'like', Input::get('category'));
            })->paginate(4);


        $emptyProjects = false;
        if ($projects->getTotal() == 0) {
            $emptyProjects = true;
        }
        //Transformamos el array en un paginator
        $data = array(
            'categories' => Session::get('categories'),
            'locations' => Session::get('locations'),
            'projects' => $projects,
            'emptyProjects' => $emptyProjects,
            'projectsOfVolunteer' => $projectsOfVolunteer,
            'authCompanyId' => $authCompanyId,
            'authVolunteerId' => $authVolunteerId,

        );
        Input::flash();
        Return View::make('company/project/list')->with($data);
    }

    public function viewCsrProject($id)
    {
        $backUrl = Session::get('backUrl');
        if (strpos($backUrl, 'projectsCsrFilter') !== false) {
            $backUrl = str_replace('Filter', '', $backUrl);
        }
        $company = Company::where('user_id', '=', Auth::id())->first();
        $volunteer = Volunteer::where('user_id', '=', Auth::id())->first();
        $this->project = Project::where('id', '=', $id)->first();

        $volunteers = $this->project->volunteers;
        $availableVolunteers = $this->project->maxVolunteers - sizeof($volunteers);
        $categories = '';
        $isCsrProject = true;


        $projectCollapseDate = Project::where(function ($query) {
        //intentamos coger los proyectos  para los que el proyecto actual empieza entre su fecha de comienzo y su fecha de fin
            $query->where($this->project->startDate, '>=', 'startDate')->where($this->project->startDate, '<=', 'finishDate');

        })->orWhere(function ($query) {
        //intentamos coger los proyectos  para los que el proyecto actual comienza antes que ellos pero finaliza despues de que finalicen ellos
            $query->where($this->project->startDate, '<', 'startDate')->where($this->project->finishDate, '>=', 'startDate');

        })->get();


        $canApply = false;
        if (!is_null($volunteer)) {

            //condiciones para añadir solicitud a un proyecto
            if ($availableVolunteers > 0 && !in_array($volunteers, $volunteer)
                && $this->project->startDate > date("Y-m-d") && isEmpty($projectCollapseDate)) {
                $canApply = true;
            }
        }

        for ($i = 0; $i < sizeof($this->project->categories); $i++) {
            $category = $this->project->categories[$i];
            if ($i == (sizeof($this->project->categories) - 1)) {
                $categories .= $category->name;
            } else {
                $categories .= $category->name . ', ';
            }
        }
        $data = array(

            'availableVolunteers' => $availableVolunteers,
            'project' => $this->project,
            'categories' => $categories,
            'isCsrProject' => $isCsrProject,
            'canApply' => $canApply,
            'backUrl' => $backUrl
        );

        //si se trata de un ngo y es su proyecto tendra boton para editar
        if (!is_null($company)) {
            if ($company->id == $this->project->company_id) {
                $data['editable'] = true;
            }

        }
        return View::make('site/project/view')->with($data);


    }
}