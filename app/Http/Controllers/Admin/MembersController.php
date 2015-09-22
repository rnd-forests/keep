<?php

namespace Keep\Http\Controllers\Admin;

use Keep\Http\Controllers\Controller;
use Keep\Repositories\Contracts\UserRepository;

class MembersController extends Controller
{
    protected $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    /**
     * Get active accounts.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $request = app('request');
        $sortBy = $request->get('sortBy');
        $direction = $request->get('direction');
        $activeMembers = $this->users->paginate(100, compact('sortBy', 'direction'));

        return view('admin.members.active_accounts', compact('activeMembers'));
    }

    /**
     * Get account profile.
     *
     * @param $slug
     * @return \Illuminate\View\View
     */
    public function show($slug)
    {
        $user = $this->users->findBySlugWithTasks($slug);

        return view('admin.members.profile', compact('user'));
    }

    /**
     * Disable an account.
     *
     * @param $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($slug)
    {
        $this->users->softDelete($slug);
        flash()->info(trans('administrator.account_disabled'));

        return redirect()->route('admin::members');
    }
}
