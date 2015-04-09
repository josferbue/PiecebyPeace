<?php

/**
 * Created by PhpStorm.
 * User: Alejandro
 * Date: 08/04/2015
 * Time: 19:12
 */
class NgoProjectController extends BaseController
{

    protected $project;

    public function __construct(Project $project)
    {
        parent::__construct();
        $this->project = $project;
    }

    public function createVolunteerProject()
    {
        // Show the page
        return View::make('site/project/createVolunteerProject');
    }


    public function saveVolunteerProject()
    {

        // Declare the rules for the form validation
        $rules = array(
            'name' => 'required|min:4',
            'description' => 'required|min:10',
            'city' => 'required|alpha|min:4',
            'country' => 'required|alpha|min:4',
            'zipCode' => 'required|integer|min:0',
            'maxVolunteers' => 'required|integer|min:0',
            'startDate' => 'required|date|after:"now"',
            'finishDate' => 'required|date|after:startDate'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes()) {
            // Create a new blog post
            $user = Auth::user();

            // Update the blog post data
            $this->project->name = Input::get('name');
            $this->project->description = Input::get('description');
            $this->project->image = Input::get('content');
            $this->project->address = Input::get("address");
            $this->project->city = Input::get("city");
            $this->project->zipCode = Input::get("zipCode");
            $this->project->maxVolunteers = Input::get("maxVolunteers");
            $this->project->country = Input::get("country");
            $this->project->startDate = Input::get("startDate");
            $this->project->finishDate = Input::get("finishDate");
            $this->project->created_at = date("Y-m-d");

            $ngo=Ngo::where('user_id', '=', $user->id)->first();
            $this->project->ngo_id =$ngo->id;

            $destinationPath = public_path().'/logos/'.$user->email;

            $image = Input::file('image');
            if ($image != null) {

                $filename = $image->getClientOriginalName();
                $image->move($destinationPath, $filename);
                $this->project->image =  '/logos/'.$user->email .'/'. $filename;

            }

            // Was the blog post created?
            if ($this->project->save()) {
                // Redirect to the new blog post page
                return Redirect::to('/' )->with('success', Lang::get('project/messages.createVolunteer.success'));
            }

            // Redirect to the blog post create page
            return Redirect::to('project/createVolunteerProject')->with('error', Lang::get('project/messages.createVolunteer.error'));
        }

        // Form validation failed
        return Redirect::to('project/createVolunteerProject')->withInput()->withErrors($validator);
    }
}