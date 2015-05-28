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
    protected $volunteer;

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
        $city = filter_var(Input::get('city'), FILTER_SANITIZE_STRING);

        $projects = Project::whereNull('company_id')->where('city', '=', $city)->where('startDate', '>', $startDate)
            ->where('finishDate', '<', $finishDate)->whereHas('categories', function ($q) {
                $q->where('category_id', '=', Input::get('category'));
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
        $this->volunteer = Volunteer::where('user_id', '=', Auth::id())->first();
        $isCsrProject = false;

        $this->project = Project::where('id', '=', $id)->first();
        $volunteers = $this->project->volunteers;
        $availableVolunteers = $this->project->maxVolunteers - sizeof($volunteers);
        $categories = '';

        $canApply = $this->canApplyProject($availableVolunteers,$volunteers);


        for ($i = 0; $i < sizeof($this->project->categories); $i++) {
            $category = $this->project->categories[$i];
            if ($i == (sizeof($this->project->categories) - 1)) {
                $categories .= Lang::get($category->name);
            } else {
                $categories .= Lang::get($category->name) . ', ';
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
        if (!is_null($ngo)) {
            if ($ngo->id == $this->project->ngo_id) {
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


        $data = array(
            'categories' => $categories,
            'locations' => $locationCsrProjects,

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
        $city = filter_var(Input::get('city'), FILTER_SANITIZE_STRING);

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
        $this->volunteer = Volunteer::where('user_id', '=', Auth::id())->first();
        $this->project = Project::where('id', '=', $id)->first();

        $volunteers = $this->project->volunteers;
        $availableVolunteers = $this->project->maxVolunteers - sizeof($volunteers);
        $categories = '';
        $isCsrProject = true;

        $canApply = $this->canApplyProject($availableVolunteers,$volunteers);

        for ($i = 0;
             $i < sizeof($this->project->categories);
             $i++) {
            $category = $this->project->categories[$i];
            if ($i == (sizeof($this->project->categories) - 1)) {
                $categories .= Lang::get($category->name);
            } else {
                $categories .= Lang::get($category->name) . ', ';
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

    public function canApplyProject($availableVolunteers, $volunteers)
    {
        $canApply = true;
        if (is_null($this->volunteer)) {
            $canApply = false;
        } else {

            //condiciones para añadir solicitud a un proyecto
            $applyYet = Application::where('volunteer_id', '=', $this->volunteer->id)
                ->where('project_id', '=', $this->project->id)->first();
            if (!is_null($applyYet)) {
                $canApply = false;
            } elseif ($availableVolunteers <= 0) {
                $canApply = false;

            } elseif ($volunteers->contains($this->volunteer)) {
                $canApply = false;

            } elseif ($this->project->finishDate <= date("Y-m-d")) {
                $canApply = false;

            } else {
                $projectOverlapsDate = Project::where(function ($query) {
                    //intentamos coger los proyectos  para los que el proyecto actual empieza entre su fecha de comienzo y su fecha de fin
                    $query->whereHas('volunteers', function ($q) {
                        $q->where('volunteer_id', '=', $this->volunteer->id);
                    })
                        ->where('startDate', '<=', $this->project->startDate)
                        ->where('finishDate', '>=', $this->project->startDate);

                })->orWhere(function ($query) {
                    //intentamos coger los proyectos  para los que el proyecto actual comienza antes que ellos pero finaliza despues de que comiencen los otros
                    $query->whereHas('volunteers', function ($q) {
                        $q->where('volunteer_id', '=', $this->volunteer->id);
                    })
                        ->where('startDate', '>=', $this->project->startDate)
                        ->where('startDate', '<=', $this->project->finishDate);

                })->get();
                if (!$projectOverlapsDate->isEmpty()) {
                    $canApply = false;
                }
            }
        }
        return $canApply;
    }

    Public function getFutureCSRProjects()
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

        $projects = Project::whereNull('ngo_id')->where('startDate', '>=', Carbon::now())->paginate(4);

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

        $emptyProjects = false;
        if ($projects->getTotal() == 0) {
            $emptyProjects = true;
        }
        //Transformamos el array en un paginator
        $data = array(
            'categories' => $categories,
            'locations' => $locationVolunteerProjects,
            'projects' => $projects,
            'emptyProjects' => $emptyProjects,
            'projectsOfVolunteer' => $projectsOfVolunteer,
            'authNgoId' => $authNgoId,
            'authVolunteerId' => $authVolunteerId,

        );

        Return View::make('company/project/list')->with($data);
    }

    Public function getFutureVolunteeringProjects()
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

        $projects = Project::whereNull('company_id')->where('startDate', '>=', Carbon::now())->paginate(4);

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

        $emptyProjects = false;
        if ($projects->getTotal() == 0) {
            $emptyProjects = true;
        }
        //Transformamos el array en un paginator
        $data = array(
            'categories' => $categories,
            'locations' => $locationVolunteerProjects,
            'projects' => $projects,
            'emptyProjects' => $emptyProjects,
            'projectsOfVolunteer' => $projectsOfVolunteer,
            'authNgoId' => $authNgoId,
            'authVolunteerId' => $authVolunteerId,

        );

        Return View::make('site/project/list')->with($data);
    }
    Public function getProjectsMap()
    {
        $config = array();
        $config['center'] = 'auto';
        $config['onboundschanged'] = 'if (!centreGot) {
            var mapCentre = map.getCenter();
            marker_0.setOptions({
                position: new google.maps.LatLng(mapCentre.lat(), mapCentre.lng())
            });
        }
        centreGot = true;';

        Gmaps::initialize($config);
        $projects = Project::whereNull('company_id')->get();
        foreach($projects as $project){
            $lat_long = Gmaps::get_lat_long_from_address($project->zipCode.' '.$project->city.', '.$project->country);
            $marker = array();
            $marker['position'] = $lat_long[0].', '.$lat_long[1];
            $marker['infowindow_content'] = '<a href=\"'.URL::to('project/view/'.$project->id).'\">'.$project->name.'</a>';
            $marker['icon'] = 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=A|9999FF|000000';
            Gmaps::add_marker($marker);
        }
        $map = Gmaps::create_map();
        $mapJs = $map['js'];
        $mapHtml = $map['html'];
        Return View::make('site/project/map' ,compact('mapHtml','mapJs'));
    }
    Public function getCSRProjectsMap()
    {
        $config = array();
        $config['center'] = 'auto';
        $config['onboundschanged'] = 'if (!centreGot) {
            var mapCentre = map.getCenter();
            marker_0.setOptions({
                position: new google.maps.LatLng(mapCentre.lat(), mapCentre.lng())
            });
        }
        centreGot = true;';

        Gmaps::initialize($config);
        $projects = Project::whereNull('ngo_id')->get();
        foreach($projects as $project){
            $lat_long = Gmaps::get_lat_long_from_address($project->zipCode.' '.$project->city.', '.$project->country);
            $marker = array();
            $marker['position'] = $lat_long[0].', '.$lat_long[1];
            $marker['infowindow_content'] = '<a href=\"'.URL::to('project/view/'.$project->id).'\">'.$project->name.'</a>';
            $marker['icon'] = 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=A|9999FF|000000';
            Gmaps::add_marker($marker);
        }
        $map = Gmaps::create_map();
        $mapJs = $map['js'];
        $mapHtml = $map['html'];
        Return View::make('site/project/map' ,compact('mapHtml','mapJs'));
    }

}