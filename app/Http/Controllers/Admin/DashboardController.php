<?php

namespace Keep\Http\Controllers\Admin;

use Keep\Http\Controllers\Controller;
use Keep\Core\Repository\Contracts\TaskRepository;
use Keep\Core\Repository\Contracts\UserRepository;
use Keep\Core\Repository\Contracts\GroupRepository;
use Keep\Core\Repository\Contracts\NotificationRepository;

class DashboardController extends Controller
{
    /**
     * Get dashboard page.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        $userCount = app(UserRepository::class)->countAll();
        $taskCount = app(TaskRepository::class)->countAll();
        $groupCount = app(GroupRepository::class)->countAll();
        $notificationCount = app(NotificationRepository::class)->countAll();

        return view('admin.dashboard',
            compact(
                'userCount',
                'taskCount',
                'groupCount',
                'notificationCount'
            )
        );
    }
}
