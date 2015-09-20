<?php

namespace Keep\Http\Controllers\Member;

use Keep\Http\Controllers\Controller;
use Keep\Http\Requests\ProfileRequest;
use Keep\Repositories\Contracts\UserRepository;

class ProfileController extends Controller
{
    protected $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
        $this->middleware('auth');
        $this->middleware('valid.user', ['except' => ['show']]);
    }

    /**
     * Show public profile.
     *
     * @param $slug
     *
     * @return \Illuminate\View\View
     */
    public function show($slug)
    {
        $user = $this->users->findBySlug($slug);

        return view('users.account.profile', compact('user'));
    }

    /**
     * Load the form to edit profile.
     *
     * @param $slug
     *
     * @return \Illuminate\View\View
     */
    public function edit($slug)
    {
        $user = $this->users->findBySlug($slug);

        return view('users.account.edit_profile', compact('user'));
    }

    /**
     * Update profile.
     *
     * @param ProfileRequest $request
     * @param $slug
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileRequest $request, $slug)
    {
        $this->users->update($request->except(['_method', '_token']), $slug);
        flash()->info(trans('controller.profile_updated'));

        return redirect()->back();
    }
}
