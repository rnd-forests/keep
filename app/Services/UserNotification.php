<?php

namespace Keep\Services;

use Keep\Repositories\Contracts\NotificationRepository;

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
        return app()->make(NotificationRepository::class)
            ->groupNotificationsFor(auth()->user()->slug)->total();
    }
}
