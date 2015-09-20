<?php

namespace Keep\Http\Controllers\Admin;

use Keep\Http\Controllers\Controller;
use Keep\Repositories\Contracts\TaskRepository;
use Keep\Repositories\Contracts\UserRepository;
use Keep\Repositories\Contracts\GroupRepository;
use Keep\Repositories\Contracts\NotificationRepository;

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
