<?php

namespace Keep\Http\Controllers\Member;

use Keep\Http\Controllers\Controller;
use Keep\Repositories\Contracts\NotificationRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
     * @param $user
     * @return \Illuminate\View\View
     */
    public function fetchNotifications($user)
    {
        $type = request()->get('type');
        if (!validate_query_string($type, ['personal', 'group'])) {
            throw new NotFoundHttpException;
        }
        if ($type == 'personal') {
            $notifications = $this->notifications->personalNotificationsFor($user);
        } else {
            $notifications = $this->notifications->groupNotificationsFor($user);
        }

        return view('users.notifications.all', compact('notifications'));
    }
}
