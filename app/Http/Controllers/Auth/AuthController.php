<?php
namespace Keep\Http\Controllers\Auth;

use Keep\Jobs\RegisterAccount;
use Keep\Jobs\ActivateAccount;
use Keep\Jobs\AuthenticateAccount;
use Keep\Http\Controllers\Controller;
use Keep\Http\Requests\OpenSessionRequest;
use Keep\Http\Requests\RegisterUserRequest;

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
        if ($this->dispatchFrom(RegisterAccount::class, $request)) {
            flash()->info('Check your email address to activate your account.');

            return redirect()->home();
        }

        return redirect()->route('auth::register');
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
        if ($this->dispatchFrom(AuthenticateAccount::class, $request, [
            'active'   => 1,
            'remember' => $request->has('remember')])
        ) {
            flash()->success('You have been logged in.');

            return redirect()->intended('/');
        }

        return redirect()->route('auth::login')->withInput($request->only('email', 'remember'))
            ->withErrors(['Your credentials are wrong or your account has not been activated.']);
    }

    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        auth()->logout();
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
        if ($this->dispatch(new ActivateAccount($code))) {
            flash()->success('Your account has been activated.');

            return redirect()->home();
        }
        flash()->warning('Something went wrong. Please check your activation link');

        return redirect()->home();
    }
}
