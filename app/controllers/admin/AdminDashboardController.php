<?php

class AdminDashboardController extends AdminController {

	/**
	 * Admin dashboard
	 *
	 */
	public function getIndex()
	{
		$ngoConsult = DB::table('users')
			->Join('ngo', 'users.id', '=', 'ngo.user_id')
			->select(DB::raw('count(*) as user_count, MONTH(created_at) as mes'))
			->groupBy('mes')
			->get();
		$volunteerConsult  = DB::table('users')
			->Join('volunteer', 'users.id', '=', 'volunteer.user_id')
			->select(DB::raw('count(*) as user_count, MONTH(created_at) as mes'))
			->groupBy('mes')
			->get();
		$companyConsult  = DB::table('users')
			->Join('company', 'users.id', '=', 'company.user_id')
			->select(DB::raw('count(*) as user_count, MONTH(created_at) as mes'))
			->groupBy('mes')
			->get();
		$ngoDataSet = array(0,0,0,0,0,0,0,0,0,0,0,0);
		$volunteerDataSet = array(0,0,0,0,0,0,0,0,0,0,0,0);
		$companyDataSet = array(0,0,0,0,0,0,0,0,0,0,0,0);
		foreach($ngoConsult as $ngo){
			$ngoDataSet[$ngo->mes] = $ngo->user_count;
		}
		foreach($volunteerConsult as $volunteer){
			$volunteerDataSet[$volunteer->mes] = $volunteer->user_count;
		}
		foreach($companyConsult as $company){
			$companyDataSet[$company->mes] = $company->user_count;
		}

		$arrayVolunteerProject = Project::whereNotNull('ngo_id')->lists('id');
		$arrayCsrProject = Project::whereNotNull('company_id')->lists('id');
		$projectMax = DB::table('project_volunteer')->select(DB::raw('count(volunteer_id) as voluntarios, project_id'))->whereIn('project_id',$arrayVolunteerProject)->groupBy("project_id")->orderBy("voluntarios","desc")->first();
		$csrMax = DB::table('project_volunteer')->select(DB::raw('count(volunteer_id) as voluntarios, project_id'))->whereIn('project_id',$arrayCsrProject)->groupBy("project_id")->orderBy("voluntarios","desc")->first();

		$ngoCount=Ngo::count();
		$companyCount=Company::count();

		$campaignMax = Campaign::where('expirationDate', '>', Carbon::now())->whereRaw('visits < maxVisits')->max('visits');
		$idCampaigns = Campaign::where('expirationDate', '>', Carbon::now())->whereRaw('visits < maxVisits')->lists('id');
		$campaign = Campaign::whereIn('id',$idCampaigns)->where('visits','=',$campaignMax)->first();

		$pieChart = array(array(Lang::get('admin/charts.lineNGO'),$ngoCount ) , array(Lang::get('admin/charts.lineVolunteer'),Volunteer::count()),array(Lang::get('admin/charts.lineCompany'),$companyCount));

		$donutChart = array(array(Lang::get('admin/charts.pieProyects'), Project::whereNotNull('ngo_id')->count()) , array(Lang::get('admin/charts.pieCsr'),Project::whereNotNull('company_id')->count()));

		$campaignAve = round(Campaign::where('expirationDate', '>', Carbon::now())->whereRaw('visits < maxVisits')->avg('visits'),2);
		$campaignMin = Campaign::where('expirationDate', '>', Carbon::now())->whereRaw('visits < maxVisits')->min('visits');

		$applicationNotAnswered = Application::where('result','=',0)->count();
		$applicationNotAccepted = Application::where('result','=',1)->count();
		$applicationAccepted = Application::where('result','=',2)->count();


		JavaScript::put([
			'lineDataSet1'			 	=> $ngoDataSet,
			'lineDataSet2'			 	=> $volunteerDataSet,
			'lineDataSet3' 				=> $companyDataSet,
			'pieDataSet' 				=> $pieChart,
			'donutDataSet' 				=> $donutChart,
			'campaignMax'				=> $campaignMax,
			'campaignAve'				=> $campaignAve,
			'campaignMin'				=> $campaignMin,
			'applicationNotAnswered'	=> $applicationNotAnswered,
			'applicationNotAccepted'	=> $applicationNotAccepted,
			'applicationAccepted'		=> $applicationAccepted




		]);
		return View::make('admin/dashboard',compact('projectMax','csrMax','campaign'));
	}

}