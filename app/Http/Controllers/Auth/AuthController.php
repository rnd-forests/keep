<?php
namespace Keep\Http\Controllers\Auth;

use Auth;
use Keep\Http\Controllers\Controller;
use Keep\Commands\ConfirmAccountCommand;
use Keep\Commands\RegisterAccountCommand;
use Keep\Http\Requests\OpenSessionRequest;
use Keep\Http\Requests\RegisterUserRequest;
use Keep\Commands\InitializeSessionCommand;

class AuthController extends Controller
{
    /**
     * Create new authentication controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
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
     * @param RegisterUserRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postRegister(RegisterUserRequest $request)
    {
        if ($this->dispatchFrom(RegisterAccountCommand::class, $request)) {
            flash()->info('Check your email address to activate your account.');

            return redirect()->home();
        }

        return redirect()->route('register');
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
     * @param OpenSessionRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postLogin(OpenSessionRequest $request)
    {
        $additionalAttributes = ['active' => 1, 'remember' => $request->has('remember')];
        if ($this->dispatchFrom(InitializeSessionCommand::class, $request, $additionalAttributes)) {
            flash()->success('You have been logged in.');

            return redirect()->intended('/');
        }

        return redirect()->route('login')->withInput($request->only('email', 'remember'))
            ->withErrors(['Your credentials are wrong or your account has not been activated.']);
    }

    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::logout();
        flash()->success('You have been logged out.');

        return redirect()->home();
    }

    /**
     * Activate user account.
     *
     * @param $code
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function activate($code)
    {
        if ($this->dispatch(new ConfirmAccountCommand($code))) {
            flash()->success('Your account has been activated.');

            return redirect()->home();
        }
        flash()->warning('Something went wrong. Please check your activation link');

        return redirect()->home();
    }
}
