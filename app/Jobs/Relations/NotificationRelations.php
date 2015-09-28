<?php

namespace Keep\Jobs\Relations;

use Keep\Jobs\Job;
use Keep\Entities\Notification;
use Illuminate\Support\Collection;
use Keep\Core\Repository\Contracts\UserRepository;
use Keep\Core\Repository\Contracts\GroupRepository;
use Keep\Core\Repository\Contracts\NotificationRepository;

abstract class NotificationRelations extends Job
{
    protected $data;
    protected static $users;
    protected static $groups;
    protected static $notifications;

    public function __construct(array $data)
    {
        $this->data = $data;
        self::$users = app(UserRepository::class);
        self::$groups = app(GroupRepository::class);
        self::$notifications = app(NotificationRepository::class);
    }

    /**
     * Set the proper polymorphic associations of a notification.
     *
     * @param Notification $notification
     * @param Collection $entities
     */
    public function setNotificationPolymorphic(Notification $notification, Collection $entities)
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
    public function updatePolymorphicRelations($notification, $users, $groups)
    {
        $this->notificationRepo->syncPolymorphicRelations($notification, $users, $groups);
    }

    public function getNotificationRequestData()
    {
        return [
            'subject' => $this->data['subject'],
            'body' => $this->data['body'],
            'type' => $this->data['type'],
        ];
    }

    public function getUserListRequestData()
    {
        return array_key_exists('user_list', $this->data) ? $this->data['user_list'] : [];
    }

    public function getGroupListRequestData()
    {
        return array_key_exists('group_list', $this->data) ? $this->data['group_list'] : [];
    }
}
