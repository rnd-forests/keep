<?php

namespace Keep\Http\Controllers\Admin;

use Request;
use Keep\Http\Controllers\Controller;
use Keep\Repositories\User\UserRepositoryInterface;

class UsersController extends Controller
{
    protected $userRepo;

    /**
     * Create new users controller instance.
     *
     * @param UserRepositoryInterface $userRepo
     */
    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    /**
     * Get active accounts.
     *
     * @return \Illuminate\View\View
     */
    public function activeAccounts()
    {
        $sortBy = Request::get('sortBy');
        $direction = Request::get('direction');
        $activeAccounts = $this->userRepo->fetchPaginatedUsers(compact('sortBy', 'direction'), 100);

        return view('admin.accounts.active_accounts', compact('activeAccounts'));
    }

    /**
     * Get disabled accounts.
     *
     * @return \Illuminate\View\View
     */
    public function disabledAccounts()
    {
        $disabledAccounts = $this->userRepo->fetchDisabledUsers(25);

        return view('admin.accounts.disabled_accounts', compact('disabledAccounts'));
    }

    /**
     * Get account profile.
     *
     * @param $slug
     *
     * @return \Illuminate\View\View
     */
    public function profile($slug)
    {
        $user = $this->userRepo->findBySlugEagerLoadTasks($slug);

        return view('admin.accounts.profile', compact('user'));
    }

    /**
     * Disable an account.
     *
     * @param $slug
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function disableAccount($slug)
    {
        $this->userRepo->softDelete($slug);
        flash()->info(trans('administrator.account_disabled'));

        return redirect()->route('admin::members.active');
    }

    /**
     * Restore a disabled account.
     *
     * @param $slug
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restoreAccount($slug)
    {
        $this->userRepo->restore($slug);
        flash()->info(trans('administrator.account_restored'));

        return redirect()->back();
    }

    /**
     * Permanently delete an account.
     *
     * @param $slug
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function forceDeleteAccount($slug)
    {
        $this->userRepo->forceDelete($slug);
        flash()->info(trans('administrator.account_destroyed'));

        return redirect()->back();
    }
}
