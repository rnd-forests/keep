<?php

namespace Keep\Http\Controllers;

use Keep\Http\Requests\ModifyProfileRequest;
use Keep\Repositories\User\UserRepositoryInterface;

class UsersController extends Controller
{
    protected $userRepo;

    /**
     * Create a new users controller instance.
     *
     * @param UserRepositoryInterface $userRepo
     */
    public function __construct(UserRepositoryInterface $userRepo)
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

        return view('users.show', compact('user'));
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
