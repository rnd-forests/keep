<?php namespace Keep\Repositories\Notification;

use Carbon\Carbon;
use Keep\User;
use Keep\Notification;

class DbNotificationRepository implements NotificationRepositoryInterface {

    public function count()
    {
        return Notification::count();
    }

    public function findBySlug($slug)
    {
        return Notification::whereSlug($slug)->firstOrFail();
    }

    public function create(array $data)
    {
        return Notification::create([
            'subject'   => $data['subject'],
            'body'      => $data['body'],
            'type'      => $data['type'],
            'sent_at'   => Carbon::now()
        ]);
    }

    public function delete($slug)
    {
        return $this->findBySlug($slug)->delete();
    }

    public function getPaginatedNotifications($limit)
    {
        return Notification::where('sent_from', 'admin')->orderBy('created_at', 'desc')->paginate($limit);
    }

    public function fetchAll($userSlug)
    {
        $user = User::findBySlug($userSlug);

        return $user->notifications()->orderBy('created_at', 'desc')->paginate(15);
    }

    public function countUserNotifications($user)
    {
        return $user->notifications()->count();
    }

}