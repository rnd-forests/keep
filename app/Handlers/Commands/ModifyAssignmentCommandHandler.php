<?php namespace Keep\Handlers\Commands;

use Keep\Commands\ModifyAssignmentCommand;
use Keep\Handlers\CommandTraits\AssignmentCommandTrait;
use Keep\Repositories\Assignment\AssignmentRepositoryInterface;
use Keep\Repositories\Task\TaskRepositoryInterface;

class ModifyAssignmentCommandHandler {

    use AssignmentCommandTrait;

    protected $taskRepo, $assignmentRepo;

    /**
     * Constructor.
     *
     * @param AssignmentRepositoryInterface $assignmentRepo
     * @param TaskRepositoryInterface       $taskRepo
     */
    public function __construct(TaskRepositoryInterface $taskRepo, AssignmentRepositoryInterface $assignmentRepo)
    {
        $this->taskRepo = $taskRepo;
        $this->assignmentRepo = $assignmentRepo;
    }

    /**
     * Handle the command.
     *
     * @param  ModifyAssignmentCommand $command
     *
     * @return void
     */
    public function handle(ModifyAssignmentCommand $command)
    {
        $assignment = $this->assignmentRepo->update($command->assignmentSlug, $this->getAssignmentRequestData($command));

        $this->updateAssociatedTask($assignment->task, $this->taskRepo, $this->getTaskRequestDataWithRelations($command));

        $this->updatePolymorphicRelations($assignment, $this->assignmentRepo, $command->userList, $command->groupList);
    }

}
