<?php

namespace Keep\Jobs\Notification;

use Keep\Jobs\Job;
use Keep\Entities\Notification;
use Illuminate\Support\Collection;
use Keep\Core\Repository\Contracts\UserRepository;
use Keep\Core\Repository\Contracts\GroupRepository;
use Keep\Core\Repository\Contracts\NotificationRepository;

abstract class NotificationJob extends Job
{
    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Set the proper polymorphic associations of a notification.
     *
     * @param Notification $notification
     * @param Collection $entities
     */
    public function setRelations(Notification $notification, Collection $entities)
    {
        $entities->each(function ($entity) use ($notification) {
            $entity->notifications()->attach($notification->id);
        });
    }

    /**
     * Sync up polymorphic relations associated with a given notification.
     *
     * @param $notification
     * @param $users
     * @param $groups
     */
    public function updateRelations($notification, $users, $groups)
    {
        app(NotificationRepository::class)
            ->syncPolymorphicRelations($notification, $users, $groups);
    }

    public function createNotification()
    {
        return app(NotificationRepository::class)
            ->create([
                'subject' => $this->data['subject'],
                'body' => $this->data['body'],
                'type' => $this->data['type'],
            ]);
    }

    public function getListOfUsers()
    {
        return app(UserRepository::class)
            ->fetchByIds(get_by_key('user_list', $this->data));
    }

    public function getListOfGroups()
    {
        return app(GroupRepository::class)
            ->fetchByIds(get_by_key('group_list', $this->data));
    }
}
