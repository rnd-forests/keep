<?php namespace Keep\Http\Controllers\Admin;

use Keep\Http\Controllers\Controller;
use Keep\Repositories\Task\TaskRepositoryInterface;
use Keep\Repositories\User\UserRepositoryInterface;
use Keep\Repositories\UserGroup\UserGroupRepositoryInterface;

class DashboardController extends Controller {

    protected $userRepo, $taskRepo, $groupRepo;

    /**
     * Create new dashboard controller instance.
     *
     * @param UserRepositoryInterface      $userRepo
     * @param TaskRepositoryInterface      $taskRepo
     * @param UserGroupRepositoryInterface $groupRepo
     */
    public function __construct(UserRepositoryInterface $userRepo, TaskRepositoryInterface $taskRepo,
                                UserGroupRepositoryInterface $groupRepo)
    {
        $this->userRepo = $userRepo;
        $this->taskRepo = $taskRepo;
        $this->groupRepo = $groupRepo;
    }

    /**
     * Get dashboard page.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        $usersCount = $this->userRepo->count();

        $tasksCount = $this->taskRepo->count();

        $groupsCount = $this->groupRepo->count();

        return view('admin.dashboard', compact('usersCount', 'tasksCount', 'groupsCount'));
    }

}