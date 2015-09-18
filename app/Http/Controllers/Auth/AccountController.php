<?php

namespace Keep\Http\Controllers\Auth;

use Keep\Jobs\UpdateUserName;
use Keep\Jobs\UpdateUserPassword;
use Keep\Http\Controllers\Controller;
use Keep\Http\Requests\UpdateNameRequest;
use Keep\Http\Requests\UpdatePasswordRequest;
use Keep\Repositories\Contracts\UserRepositoryInterface as UserRepository;

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
     * @param UpdatePasswordRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changePassword($userSlug, UpdatePasswordRequest $request)
    {
        if ($this->dispatchFrom(UpdateUserPassword::class, $request, [
            'user' => $this->users->findBySlug($userSlug), ])
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
     * @param UpdateNameRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeUsername($userSlug, UpdateNameRequest $request)
    {
        $user = $this->users->findBySlug($userSlug);
        if ($this->dispatchFrom(UpdateUserName::class, $request, ['user' => $user])) {
            session()->flash('update_username_success', trans('authentication.update_username_success'));

            return redirect()->route('member::profile', $user);
        }
        session()->flash('update_username_error', trans('authentication.update_username_error'));

        return back();
    }
}
