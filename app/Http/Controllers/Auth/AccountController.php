<?php

namespace Keep\Http\Controllers\Auth;

use Keep\Jobs\ModifyAccountName;
use Keep\Jobs\ModifyAccountPassword;
use Keep\Http\Controllers\Controller;
use Keep\Http\Requests\EditUserPasswordRequest;
use Keep\Http\Requests\EditUserUsernameRequest;
use Keep\Repositories\User\UserRepositoryInterface;

class AccountController extends Controller
{
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
        if ($this->dispatchFrom(ModifyAccountPassword::class, $request, [
            'user' => $this->userRepo->findBySlug($userSlug), ])
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
     * @param                         $userSlug
     * @param EditUserUsernameRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeUsername($userSlug, EditUserUsernameRequest $request)
    {
        $user = $this->userRepo->findBySlug($userSlug);
        if ($this->dispatchFrom(ModifyAccountName::class, $request, ['user' => $user])) {
            session()->flash('update_username_success', trans('authentication.update_username_success'));

            return redirect()->route('member::profile', $user);
        }
        session()->flash('update_username_error', trans('authentication.update_username_error'));

        return back();
    }
}
