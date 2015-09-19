<?php

namespace Keep\Http\Controllers\Admin;

use Keep\Http\Controllers\Controller;
use Keep\Repositories\Contracts\TaskRepositoryInterface;
use Keep\Repositories\Contracts\UserRepositoryInterface;
use Keep\Repositories\Contracts\GroupRepositoryInterface;
use Keep\Repositories\Contracts\NotificationRepositoryInterface;

class DashboardController extends Controller
{
    /**
     * Get dashboard page.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        $userCount = app(UserRepositoryInterface::class)->countAll();
        $taskCount = app(TaskRepositoryInterface::class)->countAll();
        $groupCount = app(GroupRepositoryInterface::class)->countAll();
        $notificationCount = app(NotificationRepositoryInterface::class)->countAll();

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
