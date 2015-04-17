<?php namespace Keep\Http\Controllers\Admin;

use Keep\Http\Controllers\Controller;
use Keep\Repositories\Task\TaskRepositoryInterface;
use Keep\Repositories\User\UserRepositoryInterface;
use Keep\Repositories\UserGroup\UserGroupRepositoryInterface;

class DashboardController extends Controller {

    protected $userRepository, $taskRepository, $groupRepository;

    /**
     * Constructor.
     *
     * @param UserRepositoryInterface      $userRepository
     * @param TaskRepositoryInterface      $taskRepository
     * @param UserGroupRepositoryInterface $groupRepository
     */
    public function __construct(UserRepositoryInterface $userRepository,
                                TaskRepositoryInterface $taskRepository,
                                UserGroupRepositoryInterface $groupRepository)
    {
        $this->userRepository = $userRepository;
        $this->taskRepository = $taskRepository;
        $this->groupRepository = $groupRepository;
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

        $groupsCount = $this->groupRepository->count();

        return view('admin.dashboard', compact('usersCount', 'tasksCount', 'groupsCount'));
    }

}