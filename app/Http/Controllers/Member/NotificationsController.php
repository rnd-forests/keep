<?php

namespace Keep\Http\Controllers\Member;

use Keep\Http\Controllers\Controller;
use Keep\Repositories\Notification\NotificationRepositoryInterface;

class NotificationsController extends Controller
{
    protected $notificationRepo;

    /**
     * Create new notifications controller instance.
     *
     * @param NotificationRepositoryInterface $notificationRepo
     */
    public function __construct(NotificationRepositoryInterface $notificationRepo)
    {
        $this->notificationRepo = $notificationRepo;
        $this->middleware('auth');
        $this->middleware('auth.correct');
    }

    /**
     * Fetch all notifications of a user.
     *
     * @param $userSlug
     * @return \Illuminate\View\View
     */
    public function fetchPersonalNotifications($userSlug)
    {
        $notifications = $this->notificationRepo->fetchPersonalNotifications($userSlug);

        return view('users.notifications.personal', compact('notifications'));
    }

    /**
     * Fetch all group notifications of a user.
     *
     * @param $userSlug
     * @return \Illuminate\View\View
     */
    public function fetchGroupNotifications($userSlug)
    {
        $notifications = $this->notificationRepo->fetchGroupNotifications($userSlug);

        return view('users.notifications.groups', compact('notifications'));
    }
}
