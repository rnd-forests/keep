<?php

namespace Keep\Jobs;

use Illuminate\Contracts\Bus\SelfHandling;
use Keep\Jobs\Relations\NotificationRelations;

class SendMemberNotification extends NotificationRelations implements SelfHandling
{
    /**
     * Send member notification.
     */
    public function handle()
    {
        $notification = parent::$notifications->create($this->getNotificationRequestData());
        $users = parent::$users->fetchUsersByIds($this->getUserListRequestData());
        $this->setNotificationPolymorphic($notification, $users);
    }
}
