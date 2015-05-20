<?php namespace Keep\Http\Controllers\Auth;

use Auth;
use Session;
use Keep\Http\Controllers\Controller;
use Keep\Commands\ModifyPasswordCommand;
use Keep\Commands\ModifyUsernameCommand;
use Keep\Http\Requests\EditUserPasswordRequest;
use Keep\Http\Requests\EditUserUsernameRequest;
use Keep\Repositories\User\UserRepositoryInterface;

class AccountController extends Controller {

    protected $userRepo;

    /**
     * Create new account controller instance.
     *
     * @param UserRepositoryInterface $userRepo
     */
    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;

        $this->middleware('auth');
    }

    /**
     * Perform the process of changing user password.
     *
     * @param                         $userSlug
     * @param EditUserPasswordRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changePassword($userSlug, EditUserPasswordRequest $request)
    {
        $user = $this->userRepo->findBySlug($userSlug);

        if ($this->dispatchFrom(ModifyPasswordCommand::class, $request, ['user' => $user]))
        {
            Session::flash('update_password_success', 'Your password has been successfully updated.');

            return redirect()->back();
        }

        Session::flash('update_password_error', 'Uh-oh! Your password could not be changed.');

        return redirect()->back();
    }

    /**
     * Perform the process of changing user username.
     *
     * @param EditUserUsernameRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeUsername(EditUserUsernameRequest $request)
    {
        if ($this->dispatchFrom(ModifyUsernameCommand::class, $request))
        {
            Session::flash('update_username_success', 'Your username has been successfully updated.');

            return redirect()->route('users.show', Auth::user());
        }

        Session::flash('update_username_error', 'Uh-oh! Your username could not be changed.');

        return redirect()->back();
    }

}
