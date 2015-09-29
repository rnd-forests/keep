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
     * Get form to create new notification for members.
     *
     * @return \Illuminate\View\View
     */
    public function notifyMembers()
    {
        session(['noti.for' => 'members']);

        return view('admin.notifications.create_for_member');
    }

    /**
     * Get form to create new notification for groups.
     *
     * @return \Illuminate\View\View
     */
    public function notifyGroups()
    {
        session(['noti.for' => 'groups']);

        return view('admin.notifications.create_for_group');
    }

    /**
     * Store new notification.
     *
     * @param NotificationRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(NotificationRequest $request)
    {
        $data = $request->except(['_token, _method']);
        if (certify_session_key('noti.for', 'members')) {
            $this->dispatch(new NotifyMembers($data));
            flash()->success(trans('administrator.notification_member'));
        } else {
            $this->dispatch(new NotifyGroups($data));
            flash()->success(trans('administrator.notification_group'));
        }

        return back();
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
}
