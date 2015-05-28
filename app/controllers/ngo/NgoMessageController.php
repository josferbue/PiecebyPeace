<?php

class NgoMessageController extends BaseController
{
    protected $message;
    public function __construct(Message $message)
    {
        parent::__construct();
        $this->message = $message;
    }

    public function createMessage($id)
    {
        $backUrl = Session::get('backUrl');
        $project = Project::where('id', '=', $id)->first();
        $volunteers = $project->volunteers;

        if($volunteers->isEmpty()){
            return Redirect::to(Session::get('backUrl'))->with('error', Lang::get('ngo/messages.createMessage.errorHasNotVolunteers'));
        }

        if($project->finishDate < Carbon::now()) {
            return Redirect::to(Session::get('backUrl'))->with('error', Lang::get('ngo/messages.createMessage.errorProjectHasFinished'));
        }

        $action = 'ngo/message/sendMessage';

        $data = array(
            'project' => $project,
            'backUrl' => $backUrl,
            'volunteers' => $volunteers,
            'action' => $action,
        );
        Return View::make('ngo/message/send')->with($data);
    }

    public function sendMessage()
    {
        $projectId = Input::get('projectId');

        // Declare the rules for the form validation
        $rules = array(
            'type' => array('required', 'regex:/broadcast|volunteer/'),
            'subject' => 'required|min:1',
            'textBox' => 'required|min:1',
        );
        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes()) {
            $project=Project::where('id','=',$projectId)->first();
            $loggingId = Auth::id();

            $ngo = Ngo::where('user_id', '=', $loggingId)->first();
            if ($project->ngo_id!=$ngo->id) {
                return Redirect::to('/')->with('error', Lang::get('ngo/messages.createMessage.errorNotHisProject'));

            }

            $this->message->subject = filter_var(Input::get('subject'), FILTER_SANITIZE_STRING);
            $this->message->textBox = filter_var(Input::get('textBox'), FILTER_SANITIZE_STRING);
            $this->message->from = $ngo->name.' '.$ngo->surname;
            $this->message->date = date("Y-m-d");

            $this->message->ngo_id = $ngo->id;

            $recipientUserVolunteer = null;
            $recipients = null;
            if (Input::get('type') == 'volunteer') {
                $volunteerId = Input::get('volunteerId');
                $recipientUserVolunteer = Volunteer::where('id', '=', $volunteerId)->first();
                if(!$project->volunteers->contains($recipientUserVolunteer)){
                    return Redirect::to(Session::get('backUrl'))->with('error', Lang::get('ngo/messages.createMessage.errorVolunteerNotInProject'));

                }
                $this->message->to = $recipientUserVolunteer->name.' '.$recipientUserVolunteer->surname;

            } else {
                $recipients =$project->volunteers;
                $this->message->to = '('.$project->name.')';

            }

            if ($this->message->save()) {
                if ($this->message->id) {
                    if ($recipientUserVolunteer) {
                        $this->message->recipients_volunteer()->attach($recipientUserVolunteer);
                    } elseif ($recipients) {//broadcast
                        foreach ($recipients as $recipient) {
                            $this->message->recipients_volunteer()->attach($recipient);
                        }
                    } else {
                        $this->message->delete();
                        return Redirect::to(Session::get('backUrl'))->with('error', Lang::get('ngo/messages.createMessage.error'));
                    }
                }

                return Redirect::to(Session::get('backUrl'))->with('success', Lang::get('ngo/messages.createMessage.success'));
            }
            return Redirect::to(Session::get('backUrl'))->with('error', Lang::get('ngo/messages.createMessage.error'));

        } else {
            return Redirect::to('ngo/message/sendMessage/' . $projectId)->withInput()->withErrors($validator);
        }
    }
}