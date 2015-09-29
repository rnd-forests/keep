<?php

namespace Keep\Http\Controllers\Admin;

use Keep\Http\Controllers\Controller;
use Keep\Jobs\Notification\NotifyGroups;
use Keep\Jobs\Notification\NotifyMembers;
use Keep\Http\Requests\NotificationRequest;
use Keep\Core\Repository\Contracts\NotificationRepository;

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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($slug)
    {
        $this->notifications->delete($slug);
        flash()->info(trans('administrator.notification_destroyed'));

        return redirect()->route('admin::notifications');
    }

    /**
     * Get form to create new notification for members.
     *
     * @return \Illuminate\View\View
     */
    public function createForMember()
    {
        session(['current.view' => 'member.noti']);

        return view('admin.notifications.create_member_notification');
    }

    /**
     * Persist notification for members to database.
     *
     * @param NotificationRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeForMember(NotificationRequest $request)
    {
        $this->dispatch(new NotifyMembers($request->all()));
        flash()->success(trans('administrator.notification_member'));

        return back();
    }

    /**
     * Get form to create new notification for groups.
     *
     * @return \Illuminate\View\View
     */
    public function createForGroup()
    {
        session(['current.view' => 'group.noti']);

        return view('admin.notifications.create_group_notification');
    }

    /**
     * Persist notification for groups to database.
     *
     * @param NotificationRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeForGroup(NotificationRequest $request)
    {
        $this->dispatch(new NotifyGroups($request->all()));
        flash()->success(trans('administrator.notification_group'));

        return back();
    }
}
