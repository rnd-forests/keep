<?php

namespace Keep\Http\Controllers\Member;

use Illuminate\Http\Request;
use Keep\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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
     * @param Request $request
     * @param $user
     * @return \Illuminate\View\View
     */
    public function fetchNotifications(Request $request, $user)
    {
        $type = $request->get('type');
        if (!$this->isCorrectType($type)) {
            throw new NotFoundHttpException();
        }
        if ($type == 'personal') {
            $notifications = $this->notifications->personalNotificationsFor($user);
        } else {
            $notifications = $this->notifications->groupNotificationsFor($user);
        }

        return view('users.notifications.all', compact('notifications'));
    }

    /**
     * Check the correctness of the query string in the url.
     *
     * @param $currentType
     * @return bool
     */
    protected function isCorrectType($currentType)
    {
        $possibleTypes = ['personal', 'group'];
        if (!$currentType || !in_array($currentType, $possibleTypes)) {
            return false;
        }

        return true;
    }
}
