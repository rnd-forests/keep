<?php namespace Keep\Http\Controllers\Auth;

use Session;
use Keep\Http\Controllers\Controller;
use Keep\Commands\ModifyPasswordCommand;
use Keep\Http\Requests\EditUserPasswordRequest;

class AccountController extends Controller {

    /**
     * Create new account controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Perform the process of changing user password.
     *
     * @param EditUserPasswordRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
	public function changePassword(EditUserPasswordRequest $request)
    {
        if ($this->dispatchFrom(ModifyPasswordCommand::class, $request))
        {
            Session::flash('update_password_success', 'Your password has been successfully updated.');

            return redirect()->back();
        }

        Session::flash('update_password_error', 'Uh-oh! Your password could not be changed.');

        return redirect()->back();
    }

}
