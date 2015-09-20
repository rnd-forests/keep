<?php

namespace Keep\Http\Controllers\Member;

use Keep\Http\Controllers\Controller;
use Keep\Http\Requests\UpdateNameRequest;
use Keep\Http\Requests\UpdatePasswordRequest;
use Keep\Repositories\Contracts\UserRepository;

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
     * Perform the process of changing user name.
     *
     * @param $userSlug
     * @param UpdateNameRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeUsername($userSlug, UpdateNameRequest $request)
    {
        $oldName = $request->get('old_name');
        $newName = $request->get('new_name');
        $user = $this->users->findBySlug($userSlug);

        if ($this->isCorrectName($oldName, $user) &&
            $this->areTheDifferentNames($oldName, $newName)
        ) {
            return $this->handleUpdateName($user, $newName);
        }
        session()->flash(
            'invalid.name',
            trans('controller.invalid_name')
        );

        return back();
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
        $oldPassword = $request->get('old_pass');
        $newPassword = $request->get('new_pass');
        $user = $this->users->findBySlug($userSlug);

        if ($this->isValidPassword($oldPassword, $user)) {
            return $this->handleUpdatePassword($user, $newPassword);
        }
        session()->flash(
            'invalid.password',
            trans('controller.invalid_password')
        );

        return back();
    }

    /**
     * Show account settings.
     *
     * @param $userSlug
     *
     * @return \Illuminate\View\View
     */
    public function account($userSlug)
    {
        $user = $this->users->findBySlug($userSlug);

        return view('users.account.account', compact('user'));
    }

    /**
     * Cancel account.
     *
     * @param $userSlug
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($userSlug)
    {
        $this->users->softDelete($userSlug);
        flash()->success(trans('controller.account_canceled'));

        return redirect()->home();
    }

    /**
     * Validate the password of a user.
     *
     * @param $password
     * @param $user
     *
     * @return mixed
     */
    protected function isValidPassword($password, $user)
    {
        return app('hash')->check($password, $user->password);
    }

    /**
     * Handle the process of updating user password.
     *
     * @param $user
     * @param $newPassword
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function handleUpdatePassword($user, $newPassword)
    {
        $user->update(['password' => $newPassword]);
        session()->flash(
            'valid.password',
            trans('controller.valid_password')
        );

        return back();
    }

    /**
     * Compare current name of a user with a new name.
     *
     * @param $name
     * @param $user
     *
     * @return bool
     */
    protected function isCorrectName($name, $user)
    {
        return strcasecmp($name, $user->name) === 0;
    }

    /**
     * Check the difference between two names.
     *
     * @param $old
     * @param $new
     *
     * @return bool
     */
    protected function areTheDifferentNames($old, $new)
    {
        return strcasecmp($old, $new) !== 0;
    }

    /**
     * Handle the process of updating user name.
     *
     * @param $user
     * @param $newName
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function handleUpdateName($user, $newName)
    {
        $user->update(['name' => $newName]);
        flash()->success(trans('controller.valid_name'));

        return redirect()->route('member::profile', $user);
    }
}
