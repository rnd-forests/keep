<?php

namespace Keep\Repositories\Notification;

use Carbon\Carbon;
use Keep\Entities\User;
use Keep\Entities\Notification;
use Keep\Repositories\EloquentRepository;

class EloquentNotificationRepository extends EloquentRepository implements NotificationRepositoryInterface
{
    protected $model;

    public function __construct(Notification $model)
    {
        $this->model = $model;
    }

    public function create(array $data)
    {
        return $this->model->create([
            'sent_from' => 'admin',
            'subject' => $data['subject'],
            'body' => $data['body'],
            'type' => $data['type'],
            'sent_at' => Carbon::now(),
        ]);
    }

    public function delete($slug)
    {
        return $this->findBySlug($slug)->delete();
    }

    public function fetchPaginatedNotifications($limit)
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

    public function countUserNotifications($user)
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
        $ids = collect();
        $user = User::findBySlug($userSlug);
        $user->groups->each(function ($group) use ($ids) {
            $group->notifications->lists('id')->each(function ($id) use ($ids) {
                $ids->push($id);
            });
        });

        return $this->model
            ->with('groups')
            ->whereIn('id', $ids->unique()->toArray())
            ->latest('created_at')
            ->paginate(15);
    }
}
