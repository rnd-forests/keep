<?php
namespace Keep\Observers;

use DB;
use Keep\Entities\Notification;

class NotificationObserver
{
    public function deleting(Notification $notification)
    {
        DB::table('notifiables')
            ->where('notification_id', $notification->id)
            ->delete();
    }
}
