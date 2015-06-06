<?php
namespace Keep\Handlers\Commands;

use Keep\Commands\CreateMemberNotificationCommand;
use Keep\Repositories\User\UserRepositoryInterface;
use Keep\Handlers\CommandTraits\NotificationCommandTrait;
use Keep\Repositories\Notification\NotificationRepositoryInterface;

class CreateMemberNotificationCommandHandler
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
     * @param  CreateMemberNotificationCommand $command
     */
    public function handle(CreateMemberNotificationCommand $command)
    {
        $notification = $this->notificationRepo->create($this->getNotificationRequestData($command));
        $users = $this->userRepo->fetchUsersByIds($command->userList);
        $this->setNotificationPolymorphic($notification, $users);
    }
}
