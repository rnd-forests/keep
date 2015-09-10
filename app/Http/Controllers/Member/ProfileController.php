<?php

namespace Keep\Http\Controllers\Member;

use Keep\Http\Controllers\Controller;
use Keep\Http\Requests\ModifyProfileRequest;
use Keep\Repositories\User\UserRepositoryInterface as UserRepository;

class ProfileController extends Controller
{
    protected $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
        $this->middleware('auth');
    }

    /**
     * Show public profile.
     *
     * @param $slug
     * @return \Illuminate\View\View
     */
    public function show($slug)
    {
        $user = $this->users->findBySlug($slug);

        return view('users.account.profile', compact('user'));
    }

    /**
     * Show account settings.
     *
     * @param $slug
     * @return \Illuminate\View\View
     */
    public function account($slug)
    {
        $user = $this->users->findBySlug($slug);
        $this->authorize('updateAccountAndProfile', $user);

        return view('users.account.account', compact('user'));
    }

    /**
     * Load the form to edit profile.
     *
     * @param $slug
     * @return \Illuminate\View\View
     */
    public function edit($slug)
    {
        $user = $this->users->findBySlug($slug);
        $this->authorize('updateAccountAndProfile', $user);

        return view('users.account.edit_profile', compact('user'));
    }

    /**
     * Update profile.
     *
     * @param ModifyProfileRequest $request
     * @param $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ModifyProfileRequest $request, $slug)
    {
        $this->users->updateProfile($request->except(['_method', '_token']), $slug);
        flash()->info(trans('controller.profile_updated'));

        return redirect()->back();
    }

    /**
     * Cancel account.
     *
     * @param $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($slug)
    {
        $this->users->softDelete($slug);
        flash()->success(trans('controller.account_canceled'));

        return redirect()->home();
    }
}
