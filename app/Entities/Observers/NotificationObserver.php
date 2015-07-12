<?php

namespace Keep\Entities\Observers;

use Keep\Entities\Notification;

class NotificationObserver
{
    public function deleting(Notification $notification)
    {
        app('db')->table('notifiables')
            ->where('notification_id', $notification->id)
            ->delete();
    }
}
