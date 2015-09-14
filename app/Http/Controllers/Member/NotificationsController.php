<?php

namespace Keep\Http\Controllers\Member;

use Keep\Http\Controllers\Controller;
use Keep\Repositories\Contracts\NotificationRepositoryInterface as NotificationRepository;

class NotificationsController extends Controller
{
    protected $notifications;

    public function __construct(NotificationRepository $notifications)
    {
        $this->notifications = $notifications;
        $this->middleware('auth');
        $this->middleware('valid.user');
    }

    /**
     * Fetch all notifications of a user.
     *
     * @param $userSlug
     * @return \Illuminate\View\View
     */
    public function fetchPersonalNotifications($userSlug)
    {
        $notifications = $this->notifications->personalNotifications($userSlug);

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
        $notifications = $this->notifications->groupNotifications($userSlug);

        return view('users.notifications.groups', compact('notifications'));
    }
}
