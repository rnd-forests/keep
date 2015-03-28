<?php  namespace Keep\Http\Controllers\Admin; 

use Keep\Http\Controllers\Controller;
use Keep\Repositories\Task\TaskRepositoryInterface;
use Keep\Repositories\User\UserRepositoryInterface;

class DashboardController extends Controller {

    protected $userRepository;
    protected $taskRepository;

    public function __construct(UserRepositoryInterface $userRepository,
                                TaskRepositoryInterface $taskRepository)
    {
        $this->userRepository = $userRepository;
        $this->taskRepository = $taskRepository;
    }

    /**
     * Get dashboard page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = $this->userRepository->getAuthUser();
        $users = $this->userRepository->all();

        $tasks = $this->taskRepository->all();

        return  view('admin.dashboard', compact('user', 'users', 'tasks'));
    }

}