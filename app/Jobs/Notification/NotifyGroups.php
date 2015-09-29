<?php

namespace Keep\Jobs\Notification;

use Illuminate\Contracts\Bus\SelfHandling;

class NotifyGroups extends NotificationJob implements SelfHandling
{
    /**
     * Send notification to groups.
     */
    public function handle()
    {
        $this->setRelations(
            $this->createNotification(),
            $this->getListOfGroups()
        );
    }
}
