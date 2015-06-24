<?php

namespace Keep\Jobs;

use Illuminate\Contracts\Bus\SelfHandling;
use Keep\Jobs\Relations\NotificationRelations;

class CreateMemberNotification extends NotificationRelations implements SelfHandling
{
    /**
     * Create member notification.
     */
    public function handle()
    {
        $notification = parent::$notiRepo->create($this->getNotificationRequestData());
        $users = parent::$userRepo->fetchUsersByIds($this->getUserListRequestData());
        $this->setNotificationPolymorphic($notification, $users);
    }
}
