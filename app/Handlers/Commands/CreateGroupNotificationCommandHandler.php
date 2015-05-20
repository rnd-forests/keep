<?php namespace Keep\Handlers\Commands;

use Keep\Commands\CreateGroupNotificationCommand;
use Keep\Handlers\CommandTraits\NotificationCommandTrait;
use Keep\Repositories\Notification\NotificationRepositoryInterface;
use Keep\Repositories\UserGroup\UserGroupRepositoryInterface;

class CreateGroupNotificationCommandHandler {

    use NotificationCommandTrait;

    protected $notificationRepo, $groupRepo;

    /**
     * Create the command handler.
     *
     * @param NotificationRepositoryInterface $notificationRepo
     * @param UserGroupRepositoryInterface    $groupRepo
     */
	public function __construct(NotificationRepositoryInterface $notificationRepo, UserGroupRepositoryInterface $groupRepo)
	{
		$this->notificationRepo = $notificationRepo;
        $this->groupRepo = $groupRepo;
	}

	/**
	 * Handle the command.
	 *
	 * @param  CreateGroupNotificationCommand  $command
	 */
	public function handle(CreateGroupNotificationCommand $command)
	{
        $notification = $this->notificationRepo->create($this->getNotificationRequestData($command));

        $groups = $this->groupRepo->fetchGroupsByIds($command->groupList);

        $this->setNotificationPolymorphic($notification, $groups);
	}

}
