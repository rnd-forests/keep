<?php namespace Keep\Handlers\Commands;

use Keep\Commands\CreateGroupAssignmentCommand;
use Keep\Repositories\Task\TaskRepositoryInterface;
use Keep\Handlers\CommandTraits\AssignmentCommandTrait;
use Keep\Repositories\UserGroup\UserGroupRepositoryInterface;
use Keep\Repositories\Assignment\AssignmentRepositoryInterface;

class CreateGroupAssignmentCommandHandler {

    use AssignmentCommandTrait;

    protected $groupRepo, $taskRepo, $assignmentRepo;

    /**
     * Constructor.
     *
     * @param TaskRepositoryInterface       $taskRepo
     * @param UserGroupRepositoryInterface  $groupRepo
     * @param AssignmentRepositoryInterface $assignmentRepo
     */
    public function __construct(TaskRepositoryInterface $taskRepo, UserGroupRepositoryInterface $groupRepo,
                                AssignmentRepositoryInterface $assignmentRepo)
    {
        $this->taskRepo = $taskRepo;
        $this->groupRepo = $groupRepo;
        $this->assignmentRepo = $assignmentRepo;
    }

    /**
     * Handle the command.
     *
     * @param CreateGroupAssignmentCommand $command
     */
    public function handle(CreateGroupAssignmentCommand $command)
    {
        $assignment = $this->assignmentRepo->create($this->getAssignmentRequestData($command));

        $task = $this->taskRepo->create($this->getTaskRequestData($command));

        $groups = $this->groupRepo->fetchGroupsByIds($command->groupList);

        $this->setRelations($command, $task, $assignment, $this->taskRepo, $groups);
    }

}
