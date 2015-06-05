<?php namespace Keep\Http\Controllers\Admin;

use Keep\Http\Controllers\Controller;
use Keep\Repositories\Task\TaskRepositoryInterface;
use Keep\Repositories\User\UserRepositoryInterface;
use Keep\Repositories\UserGroup\UserGroupRepositoryInterface;
use Keep\Repositories\Notification\NotificationRepositoryInterface;

class DashboardController extends Controller {

    protected $userRepo, $taskRepo, $groupRepo, $notificationRepo;

    /**
     * Create new dashboard controller instance.
     *
     * @param UserRepositoryInterface         $userRepo
     * @param TaskRepositoryInterface         $taskRepo
     * @param UserGroupRepositoryInterface    $groupRepo
     * @param NotificationRepositoryInterface $notificationRepo
     */
    public function __construct(UserRepositoryInterface $userRepo, TaskRepositoryInterface $taskRepo,
                                UserGroupRepositoryInterface $groupRepo, NotificationRepositoryInterface $notificationRepo)
    {
        $this->userRepo = $userRepo;
        $this->taskRepo = $taskRepo;
        $this->groupRepo = $groupRepo;
        $this->notificationRepo = $notificationRepo;
    }

    /**
     * Get dashboard page.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        $usersCount = $this->userRepo->countAll();

        $tasksCount = $this->taskRepo->countAll();

        $groupsCount = $this->groupRepo->countAll();

        $notificationCount = $this->notificationRepo->countAll();

        return view('admin.dashboard', compact('usersCount', 'tasksCount', 'groupsCount', 'notificationCount'));
    }

}