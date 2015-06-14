<?php
namespace Keep\Http\Controllers\Admin;

use Keep\Http\Controllers\Controller;
use Keep\Jobs\CreateGroupNotification;
use Keep\Jobs\CreateMemberNotification;
use Keep\Http\Requests\NotificationRequest;
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
    }

    /**
     * List all available notifications.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $notifications = $this->notificationRepo->fetchPaginatedNotifications(20);

        return view('admin.notifications.index', compact('notifications'));
    }

    /**
     * Delete a specific notification.
     *
     * @param $slug
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($slug)
    {
        $this->notificationRepo->delete($slug);
        flash()->info('This notification was successfully deleted');

        return redirect()->route('admin::notifications.all');
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
        $this->dispatchFrom(CreateMemberNotification::class, $request);
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
        $this->dispatchFrom(CreateGroupNotification::class, $request);
        flash()->success('The notification was sent to selected groups');

        return redirect()->back();
    }
}