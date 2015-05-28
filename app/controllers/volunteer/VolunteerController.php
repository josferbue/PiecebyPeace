<?php

class VolunteerController extends BaseController {

    /**
     * User Model
     * @var User
     */
    protected $volunteer;
    protected $user;
    public static $app;
    /**
     * Inject the models.
     * @param User $user
     */
    public function __construct(Volunteer $volunteer, User $user)
    {
        parent::__construct();
        $this->volunteer = $volunteer;
        $this->user = $user;
    }

    /**
     * Users settings page
     *
     * @return View
     */
    public function getIndex()
    {
        list($user,$redirect) = $this->user->checkAuthAndRedirect('/');
        if($redirect){return $redirect;}
        $volunteer = $this->volunteer;
        // Show the page
        return View::make('site/volunteer/index', compact('volunteer'));
    }

    /**
     * Stores new user
     *
     */

    public function postIndex()
    {

        $rules = array(
            'username'      => 'required|min:5|max:32|unique:users,username',
            'password'      => 'required|min:5|max:32',
            'email'    => 'required|email',
            'name'     => 'required|min:3',
            'surname'  => 'required|min:3',
            'city'     => 'required|min:3',
            'zipCode'  => 'required|min:3',
            'country'  => 'required|min:3'
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success


        $this->user->username = filter_var(Input::get('username'), FILTER_SANITIZE_STRING);
        $this->user->email = filter_var(Input::get('email'), FILTER_SANITIZE_STRING);
        $this->volunteer->name = filter_var(Input::get('name'), FILTER_SANITIZE_STRING);
        $this->volunteer->surname = filter_var(Input::get('surname'), FILTER_SANITIZE_STRING);
        $this->volunteer->address = filter_var(Input::get('address'), FILTER_SANITIZE_STRING);
        $this->volunteer->city = filter_var(Input::get('city'), FILTER_SANITIZE_STRING);
        $this->volunteer->zipCode = Input::get("zipCode");
        $this->volunteer->country = filter_var(Input::get('country'), FILTER_SANITIZE_STRING);
        $this->volunteer->biography = filter_var(Input::get('biography'), FILTER_SANITIZE_STRING);
        $password = filter_var(Input::get('password'), FILTER_SANITIZE_STRING);
        $passwordConfirmation = filter_var(Input::get('password_confirmation'), FILTER_SANITIZE_STRING);

        if(!empty($password)) {
            if($password === $passwordConfirmation) {
                $this->user->password = $password;
                // The password confirmation will be removed from model
                // before saving. This field will be used in Ardent's
                // auto validation.
                $this->user->password_confirmation = $passwordConfirmation;
            } else {
                // Redirect to the new user page
                return Redirect::to('userVolunteer/create')
                    ->withInput(Input::except('password','password_confirmation'))
                    ->with('error', Lang::get('admin/users/messages.password_does_not_match'));
            }
        } else {
            unset($this->user->password);
            unset($this->user->password_confirmation);
        }

        if ($validator->passes()) {

        // Save if valid. Password field will be hashed before save

            if(!Input::get('terms')) {
                return Redirect::to('userVolunteer/create')
                    ->withInput(Input::except('password','password_confirmation'))
                    ->with('error', Lang::get('volunteer/volunteer.termsNotAccepted'));
            }

            $this->user->save();
            if ( $this->user->id )
            {
                $this->user->attachRole( Role::where('name','=','VOLUNTEER')->first());
                $this->volunteer->user_id = $this->user->id;
                    $this->volunteer->save();

                    // Redirect with success message, You may replace "Lang::get(..." for your custom message.
                    return Redirect::to('user/login')
                        ->with('success', Lang::get('user/user.user_account_created'));

            }
            else
            {
                // Get validation errors (see Ardent package)
                $error = $this->user->errors()->all();

                return Redirect::to('userVolunteer/create')
                    ->withInput(Input::except('password'))
                    ->with( 'error', $error );
            }
        }
        else{
            return Redirect::to('userVolunteer/create')
                ->withInput(Input::except('password'))
                ->withErrors($validator);
        }
    }

    /**
     * Edits a user
     *
     */
    public
    function postEdit()
    {
        // Validate the inputs
        $volunteer = Volunteer::where('user_id', '=', Auth::id())->first();

        $rules = array(
            'password' => 'min:5|max:32',
            'email'    => 'required|email',
            'name'    => 'required|min:3',
            'surname' => 'required|min:3',
            'city'    => 'required|min:3',
            'zipCode' => 'required|min:3',
            'country' => 'required|min:3'
        );

        if ($volunteer != null) {

            $oldPassword = filter_var(Input::get('oldPassword'), FILTER_SANITIZE_STRING);
            $password = filter_var(Input::get('password'), FILTER_SANITIZE_STRING);
            $passwordConfirmation = filter_var(Input::get('password_confirmation'), FILTER_SANITIZE_STRING);

            if (!Hash::check($oldPassword, $volunteer->userAccount->password)) {
                return Redirect::to('userVolunteer/edit')
                    ->withInput(Input::except('password', 'password_confirmation', 'oldPassword'))
                    ->with('error', Lang::get('user/messages.editProfile.oldPasswordIncorrect'));
            }
            $passwordIsChanged = false;
            $emailIsChanged = false;

            if (!empty($password) || !empty($passwordConfirmation)) {
                if ($password === $passwordConfirmation) {

                    $volunteer->userAccount->password = $password;
                    // The password confirmation will be removed from model
                    // before saving. This field will be used in Ardent's
                    // auto validation.
                    $volunteer->userAccount->password_confirmation = $passwordConfirmation;
                    $passwordIsChanged = true;

                } else {
                    // Redirect to the new user page
                    return Redirect::to('userVolunteer/edit')->with('error', Lang::get('admin/users/messages.password_does_not_match'));
                }
            }
        } else {
            return Redirect::to('/')->with('error', Lang::get('user/messages.editProfile.errorEditNotYourProfile'));
        }

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->passes()) {

            if ($volunteer->userAccount->email != filter_var(Input::get('email'), FILTER_SANITIZE_STRING)) {
                $emailIsChanged=true;
                //hacemos que vuelva a enviar email de confirmacion si este se cambia
                $volunteer->userAccount->email = filter_var(Input::get('email'), FILTER_SANITIZE_STRING);

                $volunteer->userAccount->confirmation_code = md5(uniqid(mt_rand(), true));
                $volunteer->userAccount->confirmed = 0;
                if (!static::$app) {
                    static::$app = app();
                }
                $signup_cache = (int)static::$app['config']->get('confide::signup_cache');
                if ($signup_cache !== 0) {
                    static::$app['cache']->put('confirmation_email_' . $volunteer->userAccount->getKey(), false, $signup_cache);
                }
            }


            $volunteer->userAccount->email = filter_var(Input::get('email'), FILTER_SANITIZE_STRING);
            $volunteer->name = filter_var(Input::get('name'), FILTER_SANITIZE_STRING);
            $volunteer->surname = filter_var(Input::get('surname'), FILTER_SANITIZE_STRING);
            $volunteer->address = filter_var(Input::get('address'), FILTER_SANITIZE_STRING);
            $volunteer->city = filter_var(Input::get('city'), FILTER_SANITIZE_STRING);
            $volunteer->zipCode = Input::get("zipCode");
            $volunteer->country = filter_var(Input::get('country'), FILTER_SANITIZE_STRING);
            $volunteer->biography = filter_var(Input::get('biography'), FILTER_SANITIZE_STRING);



            if ($volunteer->userAccount->amend()) {//amend funcion para actualizar los usuarios
                // Redirect with success message, You may replace "Lang::get(..." for your custom message.
                if ($volunteer->save()) {
                    if ($passwordIsChanged || $emailIsChanged) {
                        Confide::logout();
                    }
                    return Redirect::to('/')
                        ->with('success', Lang::get('user/user.user_account_updated'));
                }
            }
            return Redirect::to('userVolunteer/edit')
                ->withInput(Input::except('password', 'password_confirmation', 'oldPassword'))
                ->with('error', Lang::get('user/messages.editProfile.errorEditSave'));

        } else {

            return Redirect::to('userVolunteer/edit')
                ->withInput(Input::except('password', 'password_confirmation', 'oldPassword'))
                ->withErrors($validator);
        }
    }

    /**
     * Displays the form for user creation
     *
     */
    public function getCreate()
    {
        return View::make('site/volunteer/create');
    }
    public
    function getEdit()
    {
        $volunteer = Volunteer::where('user_id', '=', Auth::id())->first();
        $isEdit = true;
        return View::make('site/volunteer/create', compact('volunteer', 'isEdit'));
    }

    // Delete volunteer

    public function deleteVolunteer() {
        if(!Auth::check()){
            Return Redirect::to('/')->with('error', Lang::get('volunteer/messages.deleteVolunteer.notLogging'));
        }
        $volunteer = Auth::user()->actor();

        if(!Auth::user()->hasRole('VOLUNTEER')) {
            Return Redirect::to('/')->with('error', Lang::get('volunteer/messages.deleteVolunteer.errorNotVolunteer'));
        }

        $applications = Application::where('volunteer_id', '=', Auth::id())->where('result', '=', 2);

        foreach($applications as $application) {
            if(Carbon::now() < $application->project->startDate) {
                Return Redirect::to('/')->with('error', Lang::get('volunteer/messages.deleteVolunteer.errorAlreadyCooperating'));
            }
        }

        if($volunteer->userAccount->delete()){
            Confide::logout();
            Return Redirect::to('/')->with('success', Lang::get('volunteer/messages.deleteVolunteer.success'));
        }
        Return Redirect::to('/')->with('error', Lang::get('volunteer/messages.deleteVolunteer.error'));

    }



}
