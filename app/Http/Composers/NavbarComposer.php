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

        $notificationCount = $notificationRepo->countUserNotifications(Auth::user());

        $view->with('notificationCount', $notificationCount);
    }

}