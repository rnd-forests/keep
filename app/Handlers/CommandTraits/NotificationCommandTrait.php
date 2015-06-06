<?php
namespace Keep\Handlers\CommandTraits;

use Keep\Entities\Notification;
use Illuminate\Support\Collection;

trait NotificationCommandTrait
{
    /**
     * Set the proper polymorphic associations of a notification.
     *
     * @param Notification $notification
     * @param Collection   $entities
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

    /**
     * Get notification form request data.
     *
     * @param $command
     *
     * @return array
     */
    public function getNotificationRequestData($command)
    {
        return [
            'subject' => $command->subject,
            'body'    => $command->body,
            'type'    => $command->type
        ];
    }
}