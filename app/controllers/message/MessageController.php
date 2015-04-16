<?php

class MessageController extends BaseController
{
    protected $columDatabase;
    protected $eloquentRecipient;

    protected $user;

    public function __construct()
    {
        parent::__construct();
    }

    public function getInbox()
    {

        $this->user = Auth::user();
        $this->columDatabase = null;
        if ($this->user->hasRole('VOLUNTEER')) {

            $this->columDatabase = 'recipient_volunteer_id';
            $this->eloquentRecipient = 'recipients_volunteer';

        } elseif ($this->user->hasRole('NonGovernmentalOrganization')) {

            $this->columDatabase = 'recipient_ngo_id';
            $this->eloquentRecipient = 'recipients_ngo';

        } elseif ($this->user->hasRole('ADMINISTRATOR')) {

            $this->columDatabase = 'recipient_administrator_id';
            $this->eloquentRecipient = 'recipients_administrator';

        } elseif ($this->user->hasRole('COMPANY')) {

            $this->columDatabase = 'recipient_company_id';
            $this->eloquentRecipient = 'recipients_company';

        }
        //otra manera que probare cuando vea que lo otr no devuelve el tipo message y da problemas
        $messages = Message::whereHas($this->eloquentRecipient, function ($q) {
            $q->where($this->columDatabase, 'like', $this->user->id);
        })->paginate(4);


        $messages = DB::table('message_recipient')->where($this->columDatabase, '=', $this->user->id)->paginate(4);
        $emptyMessages = false;
        $inbox = true;

        if ($messages->getTotal() == 0) {
            $emptyMessages = true;
        }
        View::make('', compact($messages, $emptyMessages, $inbox));

    }

    public function getSent()
    {
        $user = Auth::user();
        $columDatabase = null;
        if ($user->hasRole('VOLUNTEER')) {
            $columDatabase = 'volunteer_id';
        } elseif ($user->hasRole('NonGovernmentalOrganization')) {
            $columDatabase = 'ngo_id';
        } elseif ($user->hasRole('ADMINISTRATOR')) {
            $columDatabase = 'administrator_id';

        } elseif ($user->hasRole('COMPANY')) {
            $columDatabase = 'company_id';
        }

        $messages = Message::where($columDatabase, '=', $user->id)->first();
        $emptyMessages = false;
        $inbox = false;

        if ($messages->getTotal() == 0) {
            $emptyMessages = true;
        }
        View::make('', compact($messages, $emptyMessages, $inbox));

    }
}