<?php

namespace Keep\Jobs;

use Illuminate\Contracts\Bus\SelfHandling;
use Keep\Jobs\Relations\NotificationRelations;

class SendGroupNotification extends NotificationRelations implements SelfHandling
{
    /**
     * Send group notification.
     */
    public function handle()
    {
        $notification = parent::$notifications->create($this->getNotificationRequestData());
        $groups = parent::$groups->fetchGroupsByIds($this->getGroupListRequestData());
        $this->setNotificationPolymorphic($notification, $groups);
    }
}
