<?php
namespace Keep\Handlers\Commands;

use Keep\Commands\CreateGroupAssignment;
use Keep\Repositories\Task\TaskRepositoryInterface;
use Keep\Handlers\Commands\Traits\AssignmentCommandTrait;
use Keep\Repositories\UserGroup\UserGroupRepositoryInterface;
use Keep\Repositories\Assignment\AssignmentRepositoryInterface;

class CreateGroupAssignmentHandler
{
    use AssignmentCommandTrait;

    protected $groupRepo, $taskRepo, $assignmentRepo;

    /**
     * Constructor.
     *
     * @param TaskRepositoryInterface       $taskRepo
     * @param UserGroupRepositoryInterface  $groupRepo
     * @param AssignmentRepositoryInterface $assignmentRepo
     */
    public function __construct(TaskRepositoryInterface $taskRepo,
                                UserGroupRepositoryInterface $groupRepo,
                                AssignmentRepositoryInterface $assignmentRepo)
    {
        $this->taskRepo = $taskRepo;
        $this->groupRepo = $groupRepo;
        $this->assignmentRepo = $assignmentRepo;
    }

    /**
     * Handle the command.
     *
     * @param CreateGroupAssignment $command
     */
    public function handle(CreateGroupAssignment $command)
    {
        $assignment = $this->assignmentRepo->create($this->getAssignmentRequestData($command));
        $task = $this->taskRepo->create($this->getTaskRequestData($command));
        $groups = $this->groupRepo->fetchGroupsByIds($command->groupList);
        $this->setRelations($command, $assignment, $task, $groups);
    }
}
