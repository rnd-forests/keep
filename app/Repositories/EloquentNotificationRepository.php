<?php

namespace Keep\Repositories;

use Carbon\Carbon;
use Keep\Entities\User;
use Keep\Entities\Notification;
use Keep\Repositories\Contracts\Common\Paginateable;
use Keep\Repositories\Contracts\Common\RepositoryInterface;
use Keep\Repositories\Contracts\NotificationRepositoryInterface;

class EloquentNotificationRepository extends AbstractEloquentRepository implements
    Paginateable,
    RepositoryInterface,
    NotificationRepositoryInterface
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
            'subject'   => $data['subject'],
            'body'      => $data['body'],
            'type'      => $data['type'],
            'sent_at'   => Carbon::now(),
        ]);
    }

    public function delete($slug)
    {
        return $this->findBySlug($slug)->delete();
    }

    public function paginate($limit, array $params = null)
    {
        return $this->model
            ->where('sent_from', 'admin')
            ->latest('created_at')
            ->paginate($limit);
    }

    public function personalNotifications($userSlug)
    {
        $user = User::findBySlug($userSlug);

        return $user->notifications()
            ->latest('created_at')
            ->simplePaginate(10);
    }

    public function groupNotifications($userSlug)
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
            ->simplePaginate(10);
    }

    public function oldNotifications()
    {
        return $this->model
            ->old()
            ->get();
    }
}
