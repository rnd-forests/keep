<?php  namespace Keep\Http\Controllers\Admin; 

use Keep\Http\Controllers\Controller;
use Keep\Repositories\Task\TaskRepositoryInterface;
use Keep\Repositories\User\UserRepositoryInterface;

class DashboardController extends Controller {

    protected $userRepository, $taskRepository;

    /**
     * Constructor.
     *
     * @param UserRepositoryInterface $userRepository
     * @param TaskRepositoryInterface $taskRepository
     */
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
    public function dashboard()
    {
        $usersCount = $this->userRepository->count();

        $tasksCount = $this->taskRepository->count();

        return view('admin.dashboard', compact('usersCount', 'tasksCount'));
    }

}