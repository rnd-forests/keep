<?php namespace Keep\Repositories\Notification;

use Keep\User;

class DbNotificationRepository implements NotificationRepositoryInterface {

    public function fetchAll($userSlug)
    {
        $user = User::findBySlug($userSlug);

        return $user->notifications()->unread()->orderBy('created_at', 'desc')->paginate(50);
    }

}