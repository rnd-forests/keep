<?php
namespace Keep\Handlers\Commands;

use Keep\Commands\CreateGroupNotification;
use Keep\Handlers\Commands\Traits\NotificationCommandTrait;
use Keep\Repositories\UserGroup\UserGroupRepositoryInterface;
use Keep\Repositories\Notification\NotificationRepositoryInterface;

class CreateGroupNotificationHandler
{
    use NotificationCommandTrait;

    protected $notificationRepo, $groupRepo;

    /**
     * Create the command handler.
     *
     * @param NotificationRepositoryInterface $notificationRepo
     * @param UserGroupRepositoryInterface    $groupRepo
     */
    public function __construct(NotificationRepositoryInterface $notificationRepo,
                                UserGroupRepositoryInterface $groupRepo)
    {
        $this->notificationRepo = $notificationRepo;
        $this->groupRepo = $groupRepo;
    }

    /**
     * Handle the command.
     *
     * @param  CreateGroupNotification $command
     */
    public function handle(CreateGroupNotification $command)
    {
        $notification = $this->notificationRepo->create($this->getNotificationRequestData($command));
        $groups = $this->groupRepo->fetchGroupsByIds($command->groupList);
        $this->setNotificationPolymorphic($notification, $groups);
    }
}
