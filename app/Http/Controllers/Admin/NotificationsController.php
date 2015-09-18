<?php

namespace Keep\Http\Controllers\Admin;

use Keep\Jobs\SendGroupNotification;
use Keep\Jobs\SendMemberNotification;
use Keep\Http\Controllers\Controller;
use Keep\Http\Requests\NotificationRequest;
use Keep\Repositories\Contracts\NotificationRepositoryInterface as NotificationRepository;

class NotificationsController extends Controller
{
    protected $notifications;

    public function __construct(NotificationRepository $notifications)
    {
        $this->notifications = $notifications;
    }

    /**
     * List all available notifications.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $notifications = $this->notifications->paginate(20);

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
        $this->notifications->delete($slug);
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
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeMemberNotification(NotificationRequest $request)
    {
        $this->dispatch(new SendMemberNotification($request->all()));
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
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeGroupNotification(NotificationRequest $request)
    {
        $this->dispatch(new SendGroupNotification($request->all()));
        flash()->success(trans('administrator.notification_group'));

        return back();
    }
}
