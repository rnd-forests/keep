<?php
namespace Keep\Http\Composers;

use App;
use Auth;
use Illuminate\Contracts\View\View;
use Keep\Repositories\Notification\NotificationRepositoryInterface;

class NavbarComposer
{
    public function compose(View $view)
    {
        $notificationRepo = App::make(NotificationRepositoryInterface::class);
        if (Auth::check()) {
            $notificationCount = $notificationRepo->countUserNotifications(Auth::user());
        } else {
            $notificationCount = 0;
        }
        $view->with('notificationCount', $notificationCount);
    }
}