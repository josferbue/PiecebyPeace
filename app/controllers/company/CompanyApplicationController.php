<?php

class CompanyApplicationController extends BaseController
{

    protected $company;
    protected $project;

    public function __construct(Application $application)
    {
        parent::__construct();
        $this->application = $application;
    }

    public function findOurAnsweredApplications()
    {
        $title=Lang::get('application/list.titleAnswered');
        $this->company=Company::where('user_id','=',Auth::id())->first();

        $applications = Application::where('result', '>', 0)->groupBy('project_id')
            ->whereHas('project', function ($q) {
                $q->where('company_id', '=', $this->company->id);
            })->paginate(4);

        $backUrl=URL::previous();
        if(strpos($backUrl,'application') !== false){
            $backUrl='/';
        }
        $data = array(
            'backUrl'   => $backUrl,
            'applications' => $applications,
            'title' => $title,
        );
        Return View::make('site/application/list')->with($data);
    }

    public function findOurPendingApplications()
    {
        $title=Lang::get('application/list.titlePending');
        $this->company=Company::where('user_id','=',Auth::id())->first();

        $applications = Application::where('result', '=', 0)->groupBy('project_id')
            ->whereHas('project', function ($q) {
                $q->where('company_id', '=', $this->company->id)
                    ->where('startDate', '<', Carbon::now());
            })->paginate(4);

        $backUrl=URL::previous();
        if(strpos($backUrl,'application') !== false){
            $backUrl='/';
        }
        $data = array(
            'backUrl'   => $backUrl,
            'applications' => $applications,
            'title' => $title,
            'isPending' => true,
        );
        Return View::make('site/application/list')->with($data);
    }

    public function listApplicationsInProject($idProject, $pending)
    {
        $this->project = Project::where('id', '=', $idProject)->first();
        $this->company = Company::where('user_id', '=', Auth::id())->first();

        if ($pending == 'pending') {
            $title = Lang::get('application/list.titlePending');
            $backUrl = 'company/application/pending';

            $applications = Application::where('result', '=', 0)
                ->whereHas('project', function ($q) {
                    $q->where('ngo_id', '=', $this->company->id)
                        ->where('startDate', '<', Carbon::now())
                            ->where('id', '=', $this->project->id);
                })
                ->paginate(4);

        } else {
            $title = Lang::get('application/list.titleAnswered');

            $backUrl = 'company/application/answered';

            $applications = Application::where('result', '>', 0)
                ->whereHas('project', function ($q) {
                    $q->where('ngo_id', '=', $this->company->id)->where('id', '=', $this->project->id);
                })
                ->paginate(4);

        }

        $data = array(
            'backUrl' => $backUrl,
            'title' => $title,
            'applications' => $applications,
        );
        Return View::make('site/application/listInProject')->with($data);
    }
    public function viewApplication($id)
    {
        $application = Application::where('id', '=', $id)->first();


        if ($application->result == 0) {
            $backUrl = 'company/application/listInProject/' . $application->project->id . '/pending';

        } else {
            $backUrl = 'company/application/listInProject/' . $application->project->id . '/answered';
        }


        $data = array(
            'backUrl' => $backUrl,
            'application' => $application,
        );
        Return View::make('site/application/view')->with($data);
    }

    public function answer($id,$answer){
        $application = Application::where('id', '=', $id)->first();
        $company=Company::where('user_id','=',Auth::id())->first();
        $backUrl = '/listInProject/'.$application->project_id.'/pending';

        if($application->project->company_id!=$company->id){
            return Redirect::to($backUrl)->with('error', Lang::get('application/messages.answer.errorNotHisProject'));
        }
        if($application->result!=0){
            return Redirect::to($backUrl)->with('error', Lang::get('application/messages.answer.errorAnsweredYet'));
        }

        if($answer==1 || $answer==2){

            $application->result=$answer;

        }else{
            return Redirect::to($backUrl)->with('error', Lang::get('application/messages.answer.errorRequest'));
        }

        if($application->save()){
            if($application->result==2){

                $project=Project::where('id','=',$application->project_id)->first();
                $volunteer=Volunteer::where('id','=',$application->volunteer_id)->first();

                $project->volunteers()->attach($volunteer);
            }
            return Redirect::to('company/application/listInProject/'.$application->project_id.'/pending')->with('success', Lang::get('application/messages.answer.success'));
        }

        return Redirect::to($backUrl)->with('error', Lang::get('application/messages.answer.error'));
    }
}