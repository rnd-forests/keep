<?php

namespace Keep\Http\Controllers\Auth;

use Keep\Events\UserHasRegistered;
use Illuminate\Contracts\Auth\Guard;
use Keep\Http\Controllers\Controller;
use Keep\Http\Requests\SignInRequest;
use Keep\Http\Requests\RegistrationRequest;
use Keep\Repositories\Contracts\UserRepository;
use Keep\Entities\Concerns\Auth\ThrottlesLogins;

class AuthController extends Controller
{
    protected $users, $auth, $throttles;

    public function __construct(Guard $auth,
                                UserRepository $users,
                                ThrottlesLogins $throttles)
    {
        $this->auth = $auth;
        $this->users = $users;
        $this->throttles = $throttles;
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function getRegister()
    {
        return view('auth.register');
    }

    /**
     * Handle a registration request to the application.
     *
     * @param RegistrationRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postRegister(RegistrationRequest $request)
    {
        $credentials = $request->only(['name', 'email', 'password']);
        $user = $this->users->create($credentials);
        if (!$user) {
            return redirect()->route('auth::register');
        }
        event(new UserHasRegistered($user));
        flash()->info(trans('authentication.account_activation'));

        return redirect()->home();
    }

    /**
     * Show the application login form.
     *
     * @return \Illuminate\View\View
     */
    public function getLogin()
    {
        return view('auth.login');
    }

    /**
     * Handle a login request to the application.
     *
     * @param SignInRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postLogin(SignInRequest $request)
    {
        if ($this->throttles->hasTooManyLoginAttempts($request)) {
            return $this->throttles->sendLockoutResponse($request);
        }

        $credentials = array_merge(
            $request->only(['email', 'password']), ['active' => 1]
        );

        if ($this->auth->attempt($credentials, $request->has('remember'))) {
            flash()->success(trans('authentication.login_success'));
            $this->throttles->clearLoginAttempts($request);

            return redirect()->intended('/');
        }

        session()->flash(
            'login_error',
            trans('authentication.login_error')
        );
        $this->throttles->incrementLoginAttempts($request);

        return redirect()->route('auth::login')
            ->withInput($request->only('email', 'remember'));
    }

    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getLogout()
    {
        $this->auth->logout();
        flash()->success(trans('authentication.logout'));

        return redirect()->home();
    }

    /**
     * Activate user account.
     *
     * @param $code
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getActivate($code)
    {
        $user = $this->users->findByActivationCode($code);
        if ($this->canBeActivated($user)) {
            $this->auth->login($user);
            flash()->success(trans('authentication.activation_success'));

            return redirect()->home();
        }
        flash()->warning(trans('authentication.activation_error'));

        return redirect()->home();
    }

    /**
     * Check if user account can be activated or not.
     *
     * @param $user
     * @return bool
     */
    protected function canBeActivated($user)
    {
        return $user->update(['activation_code' => '', 'active' => true]);
    }
}
