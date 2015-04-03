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
    function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Get accounts management page.
     *
     * @return \Illuminate\View\View
     */
    public function manageAccounts()
    {
        return view('admin.manage-users');
    }

    /**
     * Get user profile.
     *
     * @param $slug
     *
     * @return \Illuminate\View\View
     */
    public function profile($slug)
    {
        $user = $this->userRepository->findBySlug($slug);

        $tasks = $this->userRepository->getTasksNotPaginated($user);

        return view('admin.users.profile', compact('user', 'tasks'));
    }

    /**
     * Delete an user account.
     *
     * @param $slug
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteAccount($slug)
    {
        $this->userRepository->delete($slug);

        flash()->success("This account has been disabled.");

        return redirect()->route('admin.manage.accounts');
    }

}