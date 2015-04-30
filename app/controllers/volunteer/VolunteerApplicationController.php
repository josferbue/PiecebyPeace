<?php

class VolunteerApplicationController extends BaseController
{
    protected $application;
    protected $volunteer;
    protected $project;

    public function __construct(Application $application)
    {
        parent::__construct();
        $this->application = $application;
    }

    public function createApplication($id)
    {

        $project = Project::where('id', '=', $id)->first();
        if(is_null($project->company_id)){
            $backUrl = URL::to('project/view/'.$id);

        }else{
            $backUrl = URL::to('projectCsr/view/'.$id);

        }
        $data = array(
            'backUrl' => $backUrl,
            'project' => $project,
        );

        Return View::make('volunteer/application/create')->with($data);
    }

    public function saveApplication($id)
    {
        $loggingId = Auth::id();
        $this->volunteer = Volunteer::where('user_id', '=', $loggingId)->first();
        $this->project = Project::where('id', '=', $id)->first();
        $volunteers = $this->project->volunteers;
        $availableVolunteers = $this->project->maxVolunteers - sizeof($volunteers);

        if(is_null($this->project->company_id)){
            $backUrl = URL::to('project/view/'.$id);

        }else{
            $backUrl = URL::to('projectCsr/view/'.$id);

        }

        if (is_null($this->volunteer)) {
            return Redirect::to($backUrl)->with('error', Lang::get('application/messages.create.errorNotIsVolunteer'));
        } else {

            //condiciones para añadir solicitud a un proyecto

            if ($volunteers->contains($this->volunteer)) {
                return Redirect::to($backUrl)->with('error', Lang::get('application/messages.create.errorIsCooperateYet'));
            }
            $applyYet=Application::where('volunteer_id','=',$this->volunteer->id)
                ->where('project_id','=',$this->project->id)->first();

            if(!is_null($applyYet)){
                return Redirect::to($backUrl)->with('error', Lang::get('application/messages.create.errorIsApplyYet'));
            }

            if($availableVolunteers <= 0) {
                return Redirect::to($backUrl)->with('error', Lang::get('application/messages.create.errorNotVolunteerPlaces'));
            }

            if ($this->project->finishDate <= date("Y-m-d")) {
                return Redirect::to($backUrl)->with('error', Lang::get('application/messages.create.errorFinishProject'));
            }


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
                return Redirect::to($backUrl)->with('error', Lang::get('application/messages.create.errorOverlapsDates'));
            }
        }


        // Declare the rules for the form validation
        $rules = array(
            'subject' => 'string',
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes()) {
            $this->application->moment = date("Y-m-d");
            $this->application->comments = Input::get('comments');
            $this->application->result = 0;
            $this->application->volunteer_id = $this->volunteer->id;
            $this->application->project_id = $id;

            if ($this->application->save()) {
                return Redirect::to($backUrl)->with('success', Lang::get('application/messages.create.success'));
            }

            return Redirect::to($backUrl)->with('error', Lang::get('application/messages.create.error'));

        } else
            return Redirect::to('volunteer/application/create/' . $id)->withInput()->withErrors($validator);

    }
}