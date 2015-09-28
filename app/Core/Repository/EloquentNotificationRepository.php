<?php

namespace Keep\Core\Repository;

use Carbon\Carbon;
use Keep\Entities\User;
use Keep\Entities\Notification;
use Keep\Core\Repository\Contracts\Common\ModelRepository;
use Keep\Core\Repository\Contracts\NotificationRepository;
use Keep\Core\Repository\Contracts\Common\ShouldBePaginated;

class EloquentNotificationRepository extends AbstractRepository implements
    ShouldBePaginated,
    ModelRepository,
    NotificationRepository
{
    protected $model;

    public function __construct(Notification $model)
    {
        $this->model = $model;
    }

    /**
     * Delete a notification.
     *
     * @param $slug
     * @return bool|null
     */
    public function delete($slug)
    {
        return $this->findBySlug($slug)->delete();
    }

    /**
     * Fetching personal notifications of a user.
     *
     * @param $user
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function personalNotificationsFor($user)
    {
        $user = User::findBySlug($user);

        return $user->notifications()
            ->latest('created_at')
            ->paginate(20);
    }

    /**
     * Fetching joined group notifications of a user.
     *
     * @param $user
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function groupNotificationsFor($user)
    {
        $ids = collect();
        $user = User::findBySlug($user);
        $user->groups->each(function ($group) use ($ids) {
            $group->notifications->lists('id')->each(function ($id) use ($ids) {
                $ids->push($id);
            });
        });

        return $this->model
            ->with('groups')
            ->whereIn('id', $ids->unique()->toArray())
            ->latest('created_at')
            ->paginate(20);
    }

    /**
     * Fetching old notifications.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function oldNotifications()
    {
        return $this->model
            ->old()
            ->get();
    }

    /**
     * Paginate a collection of models.
     *
     * @param $limit
     * @param array|null $params
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($limit, array $params = null)
    {
        return $this->model
            ->where('sent_from', 'admin')
            ->latest('created_at')
            ->paginate($limit);
    }

    /**
     * Create a new model instance.
     *
     * @param array $data
     * @return static
     */
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
}
