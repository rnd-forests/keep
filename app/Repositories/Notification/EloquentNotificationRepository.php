<?php namespace Keep\Repositories\Notification;

use DB;
use Carbon\Carbon;
use Keep\Entities\User;
use Keep\Services\KeepHelper;
use Keep\Entities\Notification;
use Keep\Repositories\DbRepository;

class EloquentNotificationRepository extends DbRepository implements NotificationRepositoryInterface {

    protected $model;

    public function __construct(Notification $model)
    {
        $this->model = $model;
    }

    public function create(array $data)
    {
        return $this->model->create([
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
        return $this->model
            ->where('sent_from', 'admin')
            ->latest('created_at')
            ->paginate($limit);
    }

    public function fetchPersonalNotifications($userSlug)
    {
        $user = User::findBySlug($userSlug);
        return $user->notifications()
            ->latest('created_at')
            ->paginate(15);
    }

    public function countUserNotifications(User $user)
    {
        return $user->notifications()->count();
    }

    public function fetchOldNotifications()
    {
        return $this->model
            ->old()
            ->get();
    }

    public function fetchGroupNotifications($userSlug)
    {
        return $this->model->with('groups')->whereIn('id', DB::table('notifiables')
            ->where('notifiable_type', 'Keep\Entities\Group')
            ->whereIn(
                'notifiable_id',
                KeepHelper::getGroupIdsRelatedToUser(User::findBySlug($userSlug))
            )->lists('notification_id'))
            ->latest('created_at')
            ->paginate(15);
    }

}