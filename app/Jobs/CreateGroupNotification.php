<?php

namespace Keep\Jobs;

use Illuminate\Contracts\Bus\SelfHandling;
use Keep\Jobs\Relations\NotificationRelations;

class CreateGroupNotification extends NotificationRelations implements SelfHandling
{
    /**
     * Create group notification.
     */
    public function handle()
    {
        $notification = parent::$notiRepo->create($this->getNotificationRequestData());
        $groups = parent::$groupRepo->fetchGroupsByIds($this->getGroupListRequestData());
        $this->setNotificationPolymorphic($notification, $groups);
    }
}
