<?php

namespace Keep\Http\Controllers\Admin;

use Keep\Http\Controllers\Controller;
use Keep\Jobs\CreateGroupNotification;
use Keep\Jobs\CreateMemberNotification;
use Keep\Http\Requests\NotificationRequest;
use Keep\Repositories\Notification\NotificationRepositoryInterface as NotificationRepo;

class NotificationsController extends Controller
{
    protected $notificationRepo;

    /**
     * Create new notifications controller instance.
     *
     * @param NotificationRepo $notificationRepo
     */
    public function __construct(NotificationRepo $notificationRepo)
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($slug)
    {
        $this->notificationRepo->delete($slug);
        flash()->info(trans('administrator.notification_destroyed'));

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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeMemberNotification(NotificationRequest $request)
    {
        $this->dispatch(new CreateMemberNotification($request->all()));
        flash()->success(trans('administrator.notification_member'));

        return back();
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeGroupNotification(NotificationRequest $request)
    {
        $this->dispatch(new CreateGroupNotification($request->all()));
        flash()->success(trans('administrator.notification_group'));

        return back();
    }
}
