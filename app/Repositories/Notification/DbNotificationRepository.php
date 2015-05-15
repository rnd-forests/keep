<?php namespace Keep\Repositories\Notification;

use Carbon\Carbon;
use Keep\User;
use Keep\Notification;

class DbNotificationRepository implements NotificationRepositoryInterface {

    public function create(array $data)
    {
        return Notification::create([
            'subject'   => $data['subject'],
            'body'      => $data['body'],
            'type'      => $data['type'],
            'is_read'   => false,
            'sent_at'   => Carbon::now()
        ]);
    }

    public function getPaginatedNotifications($limit)
    {
        return Notification::orderBy('created_at', 'desc')->paginate($limit);
    }

    public function fetchAll($userSlug)
    {
        $user = User::findBySlug($userSlug);

        return $user->notifications()->unread()->orderBy('created_at', 'desc')->paginate(50);
    }

}