<?php

namespace Keep\Http\Controllers\Member;

use Keep\Http\Controllers\Controller;
use Keep\Http\Requests\ModifyProfileRequest;
use Keep\Repositories\User\UserRepositoryInterface as UserRepo;

class ProfileController extends Controller
{
    protected $userRepo;

    /**
     * Create a new users controller instance.
     *
     * @param UserRepo $userRepo
     */
    public function __construct(UserRepo $userRepo)
    {
        $this->userRepo = $userRepo;
        $this->middleware('auth');
        $this->middleware('auth.correct');
    }

    /**
     * Show profile.
     *
     * @param $slug
     * @return \Illuminate\View\View
     */
    public function show($slug)
    {
        $user = $this->userRepo->findBySlug($slug);

        return view('users.profile', compact('user'));
    }

    /**
     * Show account settings.
     *
     * @param $slug
     * @return \Illuminate\View\View
     */
    public function account($slug)
    {
        $user = $this->userRepo->findBySlug($slug);

        return view('users.account', compact('user'));
    }

    /**
     * Load form to edit user profile.
     *
     * @param $slug
     * @return \Illuminate\View\View
     */
    public function edit($slug)
    {
        $user = $this->userRepo->findBySlug($slug);

        return view('users.edit_profile', compact('user'));
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
        $this->userRepo->updateProfile($request->except(['_method', '_token']), $slug);
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
        $this->userRepo->softDelete($slug);
        flash()->success(trans('controller.account_canceled'));

        return redirect()->home();
    }
}
