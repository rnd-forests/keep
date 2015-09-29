<?php

namespace Keep\Jobs\Notification;

use Illuminate\Contracts\Bus\SelfHandling;

class NotifyMembers extends NotificationJob implements SelfHandling
{
    /**
     * Send notification to members.
     */
    public function handle()
    {
        $this->setRelations(
            $this->createNotification(),
            $this->getListOfUsers()
        );
    }
}
