<?php

class VolunteerMessageController extends BaseController
{
    public function __construct(Message $message)
    {
        parent::__construct();
        $this->message = $message;
    }

    public function createMessage($id)
    {
        $backUrl = Session::get('backUrl');
        $project = Project::where('id', '=', $id)->first();
        $action = 'volunteer/message/sendMessage';
        if ($project->ngo_id == null) {
            $userId=Company::where('id','=',$project->company_id)->first()->user_id;
        } else {
            $userId=Ngo::where('id','=',$project->ngo_id)->first()->user_id;

        }
        $data = array(
            'userId' => $userId,
            'backUrl' => $backUrl,
            'project' => $project,
            'sendMessageAction' => $action,


        );

        Return View::make('volunteer/message/send')->with($data);
    }

    public function sendMessage()
    {
        $loggingId = Auth::id();
        $volunteer = Volunteer::where('user_id', '=', $loggingId)->first();

        $userId = Input::get('userId');

        $projectId = Input::get('projectId');
        $project = Project::where('id', '=', $projectId)->first();
        $p = $project->volunteers;
        if (!$project->volunteers->contains($volunteer)) {
            return Redirect::to('/')->with('error', Lang::get('volunteer/messages.createMessage.errorNotCooperateInProject'));

        }
        // Declare the rules for the form validation
        $rules = array(
            'subject' => 'required|min:1',
            'textBox' => 'required|min:1',
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes()) {
            $this->message->subject = Input::get('subject');
            $this->message->textBox = Input::get('textBox');
            $this->message->volunteer_id = Volunteer::where('user_id', '=', Auth::id())->first()->id;

            $recipientUserCompany = Company::where('user_id', '=', $userId)->first();
            $recipientUserNGO = Ngo::where('user_id', '=', $userId)->first();

            if ($this->message->save()) {
                if ($this->message->id) {
                    if ($recipientUserCompany) {

                        $this->message->recipients_company()->attach($recipientUserCompany);
                    } elseif ($recipientUserNGO) {
                        $this->message->recipients_ngo()->attach($recipientUserNGO);
                    } else {
                        $this->message->delete();
                        return Redirect::to(Session::get('backUrl'))->with('error', Lang::get('volunteer/messages.createMessage.error'));

                    }
                }

                return Redirect::to(Session::get('backUrl'))->with('success', Lang::get('volunteer/messages.createMessage.success'));
            }
            return Redirect::to(Session::get('backUrl'))->with('error', Lang::get('volunteer/messages.createMessage.error'));

        } else
            return Redirect::to('volunteer/message/sendMessage/' . $projectId)->withInput()->withErrors($validator);

    }

    public function createGlobalMessage()
    {
        $backUrl = Session::get('backUrl');
        $action = 'admin/message/broadcastMessage';

        $data = array(
            'backUrl' => $backUrl,
            'sendMessageAction' => $action,
        );

        Return View::make('admin/message/send')->with($data);
    }

    public function broadcastMessage()
    {
        // Declare the rules for the form validation
        $rules = array(
            'type' => array('required', 'regex:/NGOs|companies|volunteers/'),
            'subject' => 'required|min:1',
            'textBox' => 'required|min:1',
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success
        if ($validator->passes()) {
            $this->message->subject = Input::get('subject');
            $this->message->textBox = Input::get('textBox');
            $this->message->administrator_id = Administrator::where('user_id', '=', Auth::id())->first()->id;
            $recipients = null;

            if (Input::get('type') == 'NGOs') {
                $recipients = Ngo::all();
            }
            if (Input::get('type') == 'companies') {
                $recipients = Company::all();
            }
            if (Input::get('type') == 'volunteers') {
                $recipients = Volunteer::all();
            }

            if ($this->message->save()) {
                if ($this->message->id) {
                    foreach ($recipients as $recipient) {
                        if (Input::get('type') == 'NGOs') {
                            $this->message->recipients_ngo()->attach($recipient);
                        }
                        if (Input::get('type') == 'companies') {
                            $this->message->recipients_company()->attach($recipient);
                        }
                        if (Input::get('type') == 'volunteers') {
                            $this->message->recipients_volunteer()->attach($recipient);
                        }
                    }
                }

            }

            return Redirect::to('/')->with('success', Lang::get('admin/message.successfullySent'));
        } else
            return Redirect::to('admin/message/broadcastMessage')->withInput()->withErrors($validator);

    }

}