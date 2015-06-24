<?php
namespace Keep\Jobs\Traits;

use Keep\Entities\Notification;
use Illuminate\Support\Collection;

trait NotificationTrait
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
     * @return array
     */
    public function getNotificationRequestData()
    {
        return [
            'subject' => $this->subject,
            'body'    => $this->body,
            'type'    => $this->type
        ];
    }
}
