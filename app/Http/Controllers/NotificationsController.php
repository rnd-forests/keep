<?php namespace Keep\Http\Controllers;

use Keep\Repositories\Notification\NotificationRepositoryInterface;

class NotificationsController extends Controller {

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
     *
     * @return \Illuminate\View\View
     */
	public function fetchAll($userSlug)
    {
        $notifications = $this->notificationRepo->fetchAll($userSlug);

        return view('users.notifications.all', compact('notifications'));
    }

    /**
     * Fetch all group notifications of a user.
     *
     * @param $userSlug
     *
     * @return \Illuminate\View\View
     */
    public function fetchGroupNotifications($userSlug)
    {
        $notifications = $this->notificationRepo->fetchGroupNotifications($userSlug);

        return view('users.notifications.group_notifications', compact('notifications'));
    }

}
