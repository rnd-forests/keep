<?php

namespace Keep\Http\Controllers\Admin;

use Keep\Http\Controllers\Controller;
use Keep\Repositories\Contracts\UserRepository;

class MembersDisabledController extends Controller
{
    protected $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    /**
     * Get disabled accounts.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $disabledMembers = $this->users->disabled();

        return view('admin.members.disabled_accounts', compact('disabledMembers'));
    }

    /**
     * Restore a disabled account.
     *
     * @param $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($slug)
    {
        $this->users->restore($slug);
        flash()->info(trans('administrator.account_restored'));

        return back();
    }

    /**
     * Permanently delete an account.
     *
     * @param $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($slug)
    {
        $this->users->forceDelete($slug);
        flash()->info(trans('administrator.account_destroyed'));

        return back();
    }
}