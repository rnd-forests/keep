<?php

namespace Keep\Services;

use Keep\Repositories\Contracts\NotificationRepositoryInterface;

class UserNotification
{
    /**
     * Count the number of personal notifications.
     *
     * @return mixed
     */
    public function countPersonalNotifications()
    {
        return auth()->user()->notifications->count();
    }

    /**
     * Count the number of group notifications.
     *
     * @return mixed
     */
    public function countGroupNotifications()
    {
        return app()->make(NotificationRepositoryInterface::class)
            ->groupNotificationsFor(auth()->user()->slug)->total();
    }
}