<?php  namespace Keep\Http\Controllers\Admin; 

use Keep\Http\Controllers\Controller;
use Keep\Repositories\User\UserRepositoryInterface;

class UsersController extends Controller {

    /**
     * User repository.
     * @var UserRepositoryInterface
     */
    protected $userRepository;

    /**
     * Constructor.
     *
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Get active accounts.
     *
     * @return \Illuminate\View\View
     */
    public function activeAccounts()
    {
        $usersCount = $this->userRepository->count();

        $activeAccounts = $this->userRepository->getPaginatedUsers(25);

        return view('admin.active_accounts', compact('usersCount', 'activeAccounts'));
    }

    /**
     * Get disabled accounts.
     *
     * @return \Illuminate\View\View
     */
    public function disabledAccounts()
    {
        $disabledAccounts = $this->userRepository->getTrashedUsers();

        return view('admin.disabled_accounts', compact('disabledAccounts'));
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
        $user = $this->userRepository->findBySlugWithTasks($slug);

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
        $this->userRepository->delete($slug);

        flash()->success("This account has been disabled.");

        return redirect()->route('admin.active.accounts');
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
        $this->userRepository->restore($slug);

        flash()->info('This account has been restored.');

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
        $this->userRepository->forceDelete($slug);

        flash()->info('This account was permanently deleted.');

        return redirect()->back();
    }

}