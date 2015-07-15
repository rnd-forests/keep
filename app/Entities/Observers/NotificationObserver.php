<?php

namespace Keep\Entities\Observers;

use Keep\Entities\Notification;

class NotificationObserver
{
    /**
     * Hook into notification deleting event.
     *
     * @param Notification $notification
     */
    public function deleting(Notification $notification)
    {
        app('db')->table('notifiables')
            ->where('notification_id', $notification->id)
            ->delete();
    }
}
