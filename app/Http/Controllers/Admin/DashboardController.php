<?php

namespace Keep\Http\Controllers\Admin;

use Keep\Http\Controllers\Controller;
use Keep\Repositories\Contracts\TaskRepositoryInterface as TaskRepository;
use Keep\Repositories\Contracts\UserRepositoryInterface as UserRepository;
use Keep\Repositories\Contracts\GroupRepositoryInterface as GroupRepository;
use Keep\Repositories\Contracts\NotificationRepositoryInterface as NotificationRepository;

class DashboardController extends Controller
{
    protected $users, $tasks, $groups, $notifications;

    public function __construct(UserRepository $users,
                                TaskRepository $tasks,
                                GroupRepository $groups,
                                NotificationRepository $notifications)
    {
        $this->users = $users;
        $this->tasks = $tasks;
        $this->groups = $groups;
        $this->notifications = $notifications;
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
