<?php namespace Keep\Repositories\Notification;

use DB;
use Carbon\Carbon;
use Keep\Entities\User;
use Keep\Services\KeepHelper;
use Keep\Entities\Notification;

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
            'sent_from' => 'admin',
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

    public function fetchOldNotifications()
    {
        return Notification::old()->get();
    }

    public function fetchGroupNotifications($userSlug)
    {
        return Notification::with('groups')->whereIn('id', DB::table('notifiables')
            ->where('notifiable_type', 'Keep\Entities\Group')
            ->whereIn('notifiable_id', KeepHelper::getIdsOfGroupsInRelationWithUser(User::findBySlug($userSlug)))->lists('notification_id'))
            ->orderBy('created_at', 'desc')
            ->paginate(15);
    }

}