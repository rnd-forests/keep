<?php

namespace Keep\Http\Controllers\Admin;

use Keep\Http\Controllers\Controller;
use Keep\Repositories\Task\TaskRepositoryInterface as TaskRepo;
use Keep\Repositories\User\UserRepositoryInterface as UserRepo;
use Keep\Repositories\Group\GroupRepositoryInterface as GroupRepo;
use Keep\Repositories\Notification\NotificationRepositoryInterface as NotificationRepo;

class DashboardController extends Controller
{
    protected $users, $tasks, $groups, $notifications;

    /**
     * Create new dashboard controller instance.
     *
     * @param UserRepo $userRepo
     * @param TaskRepo $taskRepo
     * @param GroupRepo $groupRepo
     * @param NotificationRepo $notificationRepo
     */
    public function __construct(UserRepo $userRepo, TaskRepo $taskRepo,
                                GroupRepo $groupRepo, NotificationRepo $notificationRepo)
    {
        $this->users = $userRepo;
        $this->tasks = $taskRepo;
        $this->groups = $groupRepo;
        $this->notifications = $notificationRepo;
    }

    /**
     * Get dashboard page.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        $usersCount = $this->users->countAll();
        $tasksCount = $this->tasks->countAll();
        $groupsCount = $this->groups->countAll();
        $notificationCount = $this->notifications->countAll();

        return view('admin.dashboard', compact('usersCount', 'tasksCount', 'groupsCount', 'notificationCount'));
    }
}
