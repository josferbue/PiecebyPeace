<?php

class NgoController extends BaseController
{

    /**
     * User Model
     * @var User
     */
    protected $ngo;
    protected $user;
    public static $app;


    /**
     * Inject the models.
     * @param User $user
     */
    public function __construct(Ngo $ngo, User $user)
    {
        parent::__construct();
        $this->ngo = $ngo;
        $this->user = $user;
    }

    /**
     * Users settings page
     *
     * @return View
     */
    public function getIndex()
    {
        list($user, $redirect) = $this->user->checkAuthAndRedirect('/');
        if ($redirect) {
            return $redirect;
        }
        $ngo = $this->ngo;
        // Show the page
        return View::make('site/ngo/index', compact('ngo'));
    }

    /**
     * Stores new user
     *
     */

    public function postIndex()
    {

        $rules = array(
            'username' => 'required|min:5|max:32|unique:users,username',
            'password' => 'required|min:5|max:32',
            'email' => 'required|email',
            'name' => 'required|min:3',
            'description' => 'required|min:3',
            'phone' => 'required|regex:/\d+/',
            'logo' => 'image',
        );

        // Validate the inputs
        $validator = Validator::make(Input::all(), $rules);

        // Check if the form validates with success


        $this->user->username = filter_var(Input::get('username'), FILTER_SANITIZE_STRING);
        $this->user->email = filter_var(Input::get('email'), FILTER_SANITIZE_STRING);
        $this->ngo->name = filter_var(Input::get('name'), FILTER_SANITIZE_STRING);
        $this->ngo->description = filter_var(Input::get('description'), FILTER_SANITIZE_STRING);
        $this->ngo->phone = filter_var(Input::get('phone'), FILTER_SANITIZE_STRING);


        $destinationPath = public_path() . '/logos/' . $this->user->email;


        //Active y Banned no hace falta ponerlos, en la base de datos van por defecto a falso

        $password = filter_var(Input::get('password'), FILTER_SANITIZE_STRING);
        $passwordConfirmation = filter_var(Input::get('password_confirmation'), FILTER_SANITIZE_STRING);

        if (!empty($password)) {
            if ($password === $passwordConfirmation) {
                $this->user->password = $password;
                // The password confirmation will be removed from model
                // before saving. This field will be used in Ardent's
                // auto validation.
                $this->user->password_confirmation = $passwordConfirmation;
            } else {
                // Redirect to the new user page
                return Redirect::to('userNgo/create')
                    ->withInput(Input::except('password', 'password_confirmation'))
                    ->with('error', Lang::get('admin/users/messages.password_does_not_match'));
            }
        } else {
            unset($this->user->password);
            unset($this->user->password_confirmation);
        }

        if ($validator->passes()) {

            // Save if valid. Password field will be hashed before save
            if(!Input::get('terms')) {
                return Redirect::to('userNgo/create')
                    ->withInput(Input::except('password','password_confirmation'))
                    ->with('error', Lang::get('ngo/ngo.termsNotAccepted'));
            }

            $this->user->save();
            if ($this->user->id) {
                $this->user->attachRole(Role::where('name', '=', 'NonGovernmentalOrganization')->first());
                $this->ngo->user_id = $this->user->id;

                //si pasa la validacion se guarda la imagen, si es que han subido alguna

                $logo = Input::file('logo');
                if ($logo != null) {

                    $filename = $logo->getClientOriginalName();
                    $logo->move($destinationPath, $filename);
                    $this->ngo->logo = '/logos/' . $this->user->email . '/' . $filename;

                } else {
                    $this->ngo->logo = '/logos/imageNotFound.gif';
                }
                $this->ngo->save();

                // Redirect with success message, You may replace "Lang::get(..." for your custom message.
                return Redirect::to('user/login')
                    ->with('success', Lang::get('user/user.user_account_created'));

            } else {
                // Get validation errors (see Ardent package)
                $error = $this->user->errors()->all();

                return Redirect::to('userNgo/create')
                    ->withInput(Input::except('password'))
                    ->with('error', $error);
            }
        } else {
            return Redirect::to('userNgo/create')
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
        $ngo = Ngo::where('user_id', '=', Auth::id())->first();

        $rules = array(
            'password' => 'min:5|max:32',
            'email' => 'required|email',
            'name' => 'required|min:3',
            'description' => 'required|min:3',
            'phone' => 'required|regex:/\d+/',
            'logo' => 'image',
        );

        if ($ngo != null) {

            $oldPassword = filter_var(Input::get('oldPassword'), FILTER_SANITIZE_STRING);
            $password = filter_var(Input::get('password'), FILTER_SANITIZE_STRING);
            $passwordConfirmation = filter_var(Input::get('password_confirmation'), FILTER_SANITIZE_STRING);

            if (!Hash::check($oldPassword, $ngo->userAccount->password)) {
                return Redirect::to('userNgo/edit')
                    ->withInput(Input::except('password', 'password_confirmation', 'oldPassword'))
                    ->with('error', Lang::get('user/messages.editProfile.oldPasswordIncorrect'));
            }
            $passwordIsChanged = false;
            $emailIsChanged = false;

            if (!empty($password) || !empty($passwordConfirmation)) {
                if ($password === $passwordConfirmation) {

                    $ngo->userAccount->password = $password;
                    // The password confirmation will be removed from model
                    // before saving. This field will be used in Ardent's
                    // auto validation.
                    $ngo->userAccount->password_confirmation = $passwordConfirmation;
                    $passwordIsChanged = true;

                } else {
                    // Redirect to the new user page
                    return Redirect::to('userNgo/edit')->with('error', Lang::get('admin/users/messages.password_does_not_match'));
                }
            }
        } else {
            return Redirect::to('/')->with('error', Lang::get('user/messages.editProfile.errorEditNotYourProfile'));
        }

        // Validate the inputs
//        $validator = Validator::make(Input::all(), $user->getUpdateRules());

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->passes()) {


            if ($ngo->userAccount->email != filter_var(Input::get('email'), FILTER_SANITIZE_STRING)) {
                $emailIsChanged=true;
                //hacemos que vuelva a enviar email de confirmacion si este se cambia
                $ngo->userAccount->email = filter_var(Input::get('email'), FILTER_SANITIZE_STRING);

                $ngo->userAccount->confirmation_code = md5(uniqid(mt_rand(), true));
                $ngo->userAccount->confirmed = 0;
                if (!static::$app) {
                    static::$app = app();
                }
                $signup_cache = (int)static::$app['config']->get('confide::signup_cache');
                if ($signup_cache !== 0) {
                    static::$app['cache']->put('confirmation_email_' . $ngo->userAccount->getKey(), false, $signup_cache);
                }
            }


            $ngo->userAccount->email = filter_var(Input::get('email'), FILTER_SANITIZE_STRING);
            $ngo->name = filter_var(Input::get('name'), FILTER_SANITIZE_STRING);
            $ngo->description = filter_var(Input::get('description'), FILTER_SANITIZE_STRING);
            $ngo->phone = filter_var(Input::get('phone'), FILTER_SANITIZE_STRING);

            $destinationPath = public_path() . '/logos/' . $ngo->userAccount->email;

            $logo = Input::file('logo');
            if ($logo != null) {

                $filename = $logo->getClientOriginalName();
                $logo->move($destinationPath, $filename);
                $ngo->logo = '/logos/' . $ngo->userAccount->email . '/' . $filename;
            }

            if ($ngo->userAccount->amend()) {//amend funcion para actualizar los usuarios
                // Redirect with success message, You may replace "Lang::get(..." for your custom message.
                if ($ngo->save()) {
                    if ($passwordIsChanged || $emailIsChanged) {
                        Confide::logout();
                    }
                    return Redirect::to('/')
                        ->with('success', Lang::get('user/user.user_account_updated'));
                }
            }
            return Redirect::to('userNgo/edit')
                ->withInput(Input::except('password', 'password_confirmation', 'oldPassword'))
                ->with('error', Lang::get('user/messages.editProfile.errorEditSave'));

        } else {

            return Redirect::to('userNgo/edit')
                ->withInput(Input::except('password', 'password_confirmation', 'oldPassword'))
                ->withErrors($validator);
        }
    }


    /**
     * Displays the form for user creation
     *
     */
    public
    function getCreate()
    {
        return View::make('site/ngo/create');
    }

    public
    function getEdit()
    {
        $ngo = Ngo::where('user_id', '=', Auth::id())->first();
        $isEdit = true;
        return View::make('site/ngo/create', compact('ngo', 'isEdit'));
    }


    /**
     * Displays the login form
     *
     */
    public
    function getLogin()
    {
        $user = Auth::user();
        if (!empty($user->id)) {
            return Redirect::to('/');
        }

        return View::make('site/user/login');
    }

    /**
     * Attempt to do login
     *
     */
    public
    function postLogin()
    {
        $input = array(
            'email' => filter_var(Input::get('email'), FILTER_SANITIZE_STRING), // May be the username too
            'username' => filter_var(Input::get('email'), FILTER_SANITIZE_STRING), // May be the username too
            'password' => filter_var(Input::get('password'), FILTER_SANITIZE_STRING),
            'remember' => Input::get('remember'),
        );

        // If you wish to only allow login from confirmed users, call logAttempt
        // with the second parameter as true.
        // logAttempt will check if the 'email' perhaps is the username.
        // Check that the user is confirmed.
        if (Confide::logAttempt($input, true)) {
            return Redirect::intended('/');
        } else {
            // Check if there was too many login attempts
            if (Confide::isThrottled($input)) {
                $err_msg = Lang::get('confide::confide.alerts.too_many_attempts');
            } elseif ($this->user->checkUserExists($input) && !$this->user->isConfirmed($input)) {
                $err_msg = Lang::get('confide::confide.alerts.not_confirmed');
            } else {
                $err_msg = Lang::get('confide::confide.alerts.wrong_credentials');
            }

            return Redirect::to('user/login')
                ->withInput(Input::except('password'))
                ->with('error', $err_msg);
        }
    }

    /**
     * Attempt to confirm account with code
     *
     * @param  string $code
     */
    public
    function getConfirm($code)
    {
        if (Confide::confirm($code)) {
            return Redirect::to('user/login')
                ->with('notice', Lang::get('confide::confide.alerts.confirmation'));
        } else {
            return Redirect::to('user/login')
                ->with('error', Lang::get('confide::confide.alerts.wrong_confirmation'));
        }
    }

    /**
     * Displays the forgot password form
     *
     */
    public
    function getForgot()
    {
        return View::make('site/user/forgot');
    }

    /**
     * Attempt to reset password with given email
     *
     */
    public
    function postForgot()
    {
        if (Confide::forgotPassword(filter_var(Input::get('email'), FILTER_SANITIZE_STRING))) {
            return Redirect::to('user/login')
                ->with('notice', Lang::get('confide::confide.alerts.password_forgot'));
        } else {
            return Redirect::to('user/forgot')
                ->withInput()
                ->with('error', Lang::get('confide::confide.alerts.wrong_password_forgot'));
        }
    }

    /**
     * Shows the change password form with the given token
     *
     */
    public
    function getReset($token)
    {

        return View::make('site/user/reset')
            ->with('token', $token);
    }


    /**
     * Attempt change password of the user
     *
     */
    public
    function postReset()
    {
        $input = array(
            'token' => filter_var(Input::get('token'), FILTER_SANITIZE_STRING),
            'password' => filter_var(Input::get('password'), FILTER_SANITIZE_STRING),
            'password_confirmation' => filter_var(Input::get('password_confirmation'), FILTER_SANITIZE_STRING),
        );

        // By passing an array with the token, password and confirmation
        if (Confide::resetPassword($input)) {
            return Redirect::to('user/login')
                ->with('notice', Lang::get('confide::confide.alerts.password_reset'));
        } else {
            return Redirect::to('user/reset/' . $input['token'])
                ->withInput()
                ->with('error', Lang::get('confide::confide.alerts.wrong_password_reset'));
        }
    }

    /**
     * Log the user out of the application.
     *
     */
    public
    function getLogout()
    {
        Confide::logout();

        return Redirect::to('/');
    }

    /**
     * Get user's profile
     * @param $username
     * @return mixed
     */
    public
    function getProfile($username)
    {
        $userModel = new User;
        $user = $userModel->getUserByUsername($username);

        // Check if the user exists
        if (is_null($user)) {
            return App::abort(404);
        }

        return View::make('site/user/profile', compact('user'));
    }

    public
    function getSettings()
    {
        list($user, $redirect) = User::checkAuthAndRedirect('user/settings');
        if ($redirect) {
            return $redirect;
        }

        return View::make('site/user/profile', compact('user'));
    }

    /**
     * Process a dumb redirect.
     * @param $url1
     * @param $url2
     * @param $url3
     * @return string
     */
    public
    function processRedirect($url1, $url2, $url3)
    {
        $redirect = '';
        if (!empty($url1)) {
            $redirect = $url1;
            $redirect .= (empty($url2) ? '' : '/' . $url2);
            $redirect .= (empty($url3) ? '' : '/' . $url3);
        }
        return $redirect;
    }

    // Ngo details
    public function details($id) {
        $ngo = Ngo::find($id);

        $data = array(
            'ngo'     => $ngo,
        );

        if(!$ngo) {
            Return Redirect::to('/')->with('error', Lang::get('ngo/ngo.notFound'));
        } elseif(!$ngo->active) {
            Return Redirect::to('/')->with('error', Lang::get('ngo/ngo.notActive'));
        } else {
            Return View::make('site/ngo/details')->with($data);
        }
    }
}
