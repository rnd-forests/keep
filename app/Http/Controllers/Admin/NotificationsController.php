<?php namespace Keep\Http\Controllers\Admin;

use Keep\Http\Controllers\Controller;
use Keep\Http\Requests\NotificationRequest;
use Keep\Commands\CreateGroupNotificationCommand;
use Keep\Commands\CreateMemberNotificationCommand;
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
    }

    /**
     * List all available notifications.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {

        return view('admin.notifications.index');
    }

    /**
     * Get form to create new notification for members.
     *
     * @return \Illuminate\View\View
     */
    public function createMemberNotification()
    {
        return view('admin.notifications.create_member_notification');
    }

    /**
     * Persist notification for members to database.
     *
     * @param NotificationRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeMemberNotification(NotificationRequest $request)
    {
        $this->dispatchFrom(CreateMemberNotificationCommand::class, $request);

        flash()->success('The notification was sent to selected members');

        return redirect()->back();
    }

    /**
     * Get form to create new notification for groups.
     *
     * @return \Illuminate\View\View
     */
    public function createGroupNotification()
    {
        return view('admin.notifications.create_group_notification');
    }

    /**
     * Persist notification for groups to database.
     *
     * @param NotificationRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeGroupNotification(NotificationRequest $request)
    {
        $this->dispatchFrom(CreateGroupNotificationCommand::class, $request);

        flash()->success('The notification was sent to selected groups');

        return redirect()->back();
    }

}