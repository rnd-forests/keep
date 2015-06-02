<?php namespace Keep\Http\Controllers\Auth;

use Keep\Http\Controllers\Controller;
use Keep\Commands\ConfirmAccountCommand;
use Keep\Commands\RegisterAccountCommand;
use Keep\Http\Requests\RegisterUserRequest;

class RegistrationsController extends Controller {

    /**
     * Create new registrations controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function create()
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
    public function store(RegisterUserRequest $request)
    {
        if ($this->dispatchFrom(RegisterAccountCommand::class, $request))
        {
            flash()->info('Check your email address to activate your account.');

            return redirect()->home();
        }

        return redirect()->route('register');
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
        if ($this->dispatch(new ConfirmAccountCommand($code)))
        {
            flash()->success('Your account has been activated.');

            return redirect()->home();
        }

        flash()->warning('Something went wrong. Please check your activation link');

        return redirect()->home();
    }

}
