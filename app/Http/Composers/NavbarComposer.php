<?php namespace Keep\Http\Composers;

use App;
use Auth;
use Illuminate\Contracts\View\View;

class NavbarComposer {

    /**
     * Compose main navigation view.
     *
     * @param View $view
     */
    public function compose(View $view)
    {
        $notificationRepo = App::make('Keep\Repositories\Notification\NotificationRepositoryInterface');

        if (Auth::check())
        {
            $notificationCount = $notificationRepo->countUserNotifications(Auth::user());
        }
        else
        {
            $notificationCount = 0;
        }

        $view->with('notificationCount', $notificationCount);
    }

}