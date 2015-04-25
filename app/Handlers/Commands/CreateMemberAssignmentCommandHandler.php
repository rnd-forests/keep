<?php namespace Keep\Handlers\Commands;

use Keep\Commands\CreateMemberAssignmentCommand;
use Keep\Repositories\Task\TaskRepositoryInterface;
use Keep\Repositories\User\UserRepositoryInterface;
use Keep\Handlers\CommandTraits\AssignmentCommandTrait;
use Keep\Repositories\Assignment\AssignmentRepositoryInterface;

class CreateMemberAssignmentCommandHandler {

    use AssignmentCommandTrait;

    protected $userRepo, $taskRepo, $assignmentRepo;

    /**
     * Constructor.
     *
     * @param UserRepositoryInterface       $userRepo
     * @param TaskRepositoryInterface       $taskRepo
     * @param AssignmentRepositoryInterface $assignmentRepo
     */
    public function __construct(UserRepositoryInterface $userRepo, TaskRepositoryInterface $taskRepo,
                                AssignmentRepositoryInterface $assignmentRepo)
    {
        $this->userRepo = $userRepo;
        $this->taskRepo = $taskRepo;
        $this->assignmentRepo = $assignmentRepo;
    }

    /**
     * Handle the command.
     *
     * @param CreateMemberAssignmentCommand $command
     */
    public function handle(CreateMemberAssignmentCommand $command)
    {
        $assignment = $this->assignmentRepo->create($this->getAssignmentRequestData($command));

        $task = $this->taskRepo->create($this->getTaskRequestData($command));

        $users = $this->userRepo->fetchUsersByIds($command->userList);

        $this->setRelations($command, $assignment, $task, $users);
    }

}
