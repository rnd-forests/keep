<?php

namespace Keep\Http\Controllers\Auth;

use Keep\Jobs\ModifyUserName;
use Keep\Jobs\ModifyUserPassword;
use Keep\Http\Controllers\Controller;
use Keep\Http\Requests\ModifyPasswordRequest;
use Keep\Http\Requests\ModifyUsernameRequest;
use Keep\Repositories\User\UserRepositoryInterface as UserRepository;

class AccountController extends Controller
{
    protected $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
        $this->middleware('auth');
        $this->middleware('valid.user');
    }

    /**
     * Perform the process of changing user password.
     *
     * @param $userSlug
     * @param ModifyPasswordRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changePassword($userSlug, ModifyPasswordRequest $request)
    {
        if ($this->dispatchFrom(ModifyUserPassword::class, $request, [
            'user' => $this->users->findBySlug($userSlug),])
        ) {
            session()->flash('update_password_success', trans('authentication.updated_password_success'));

            return back();
        }
        session()->flash('update_password_error', trans('authentication.update_password_error'));

        return back();
    }

    /**
     * Perform the process of changing user username.
     *
     * @param $userSlug
     * @param ModifyUsernameRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeUsername($userSlug, ModifyUsernameRequest $request)
    {
        $user = $this->users->findBySlug($userSlug);
        if ($this->dispatchFrom(ModifyUserName::class, $request, ['user' => $user])) {
            session()->flash('update_username_success', trans('authentication.update_username_success'));

            return redirect()->route('member::profile', $user);
        }
        session()->flash('update_username_error', trans('authentication.update_username_error'));

        return back();
    }
}
