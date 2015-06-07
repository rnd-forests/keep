<?php
namespace Keep\Handlers\Commands;

use Keep\Commands\CreateMemberNotification;
use Keep\Repositories\User\UserRepositoryInterface;
use Keep\Handlers\Commands\Traits\NotificationCommandTrait;
use Keep\Repositories\Notification\NotificationRepositoryInterface;

class CreateMemberNotificationHandler
{
    use NotificationCommandTrait;

    protected $notificationRepo, $userRepo;

    /**
     * Create the command handler.
     *
     * @param NotificationRepositoryInterface $notificationRepo
     * @param UserRepositoryInterface         $userRepo
     */
    public function __construct(NotificationRepositoryInterface $notificationRepo,
                                UserRepositoryInterface $userRepo)
    {
        $this->notificationRepo = $notificationRepo;
        $this->userRepo = $userRepo;
    }

    /**
     * Handle the command.
     *
     * @param  CreateMemberNotification $command
     */
    public function handle(CreateMemberNotification $command)
    {
        $notification = $this->notificationRepo->create($this->getNotificationRequestData($command));
        $users = $this->userRepo->fetchUsersByIds($command->userList);
        $this->setNotificationPolymorphic($notification, $users);
    }
}
