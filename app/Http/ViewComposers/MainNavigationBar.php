<?php
namespace Keep\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Keep\Repositories\Notification\NotificationRepositoryInterface;

class MainNavigationBar
{
    public function compose(View $view)
    {
        $notificationRepo = app()->make(NotificationRepositoryInterface::class);
        if (auth()->check()) {
            $notificationCount = $notificationRepo->countUserNotifications(auth()->user());
        } else {
            $notificationCount = 0;
        }
        $view->with('notificationCount', $notificationCount);
    }
}
