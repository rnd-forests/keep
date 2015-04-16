<?php namespace Keep\Http\Controllers\Auth;

use Auth;
use Keep\Http\Controllers\Controller;
use Keep\Commands\InitializeSessionCommand;
use Keep\Http\Requests\OpenSessionRequest;

class SessionsController extends Controller {

    /**
     * Create new sessions controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'destroy']);
    }

    /**
     * Show the application login form.
     *
     * @return \Illuminate\View\View
     */
	public function create()
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
	public function store(OpenSessionRequest $request)
	{
        $additionalAttributes = ['active' => 1, 'remember' => $request->has('remember')];

        if ($this->dispatchFrom(InitializeSessionCommand::class, $request, $additionalAttributes))
        {
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
	public function destroy()
	{
        Auth::logout();

        flash()->success('You have been logged out.');

        return redirect()->route('home');
	}

}
