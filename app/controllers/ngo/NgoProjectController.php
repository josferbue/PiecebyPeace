<?php
/**
 * Created by PhpStorm.
 * User: Alejandro
 * Date: 08/04/2015
 * Time: 19:12
 */

class NgoProjectController extends BaseController{

    protected $project;

    public function __construct(Project $project )
    {
        parent::__construct();
        $this->project = $project;
    }

    public function createVolunteerProject()
    {
        // Show the page
        return View::make('site/project/createVolunteerProject');
    }


    public function saveVolunteerProject(){

    }
}