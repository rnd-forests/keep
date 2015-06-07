<?php
namespace Keep\Handlers\Commands;

use Keep\Commands\ModifyAssignment;
use Keep\Repositories\Task\TaskRepositoryInterface;
use Keep\Handlers\Commands\Traits\AssignmentCommandTrait;
use Keep\Repositories\Assignment\AssignmentRepositoryInterface;

class ModifyAssignmentHandler
{
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
     * @param  ModifyAssignment $command
     *
     * @return void
     */
    public function handle(ModifyAssignment $command)
    {
        $assignment = $this->assignmentRepo->update($command->assignmentSlug, $this->getAssignmentRequestData($command));
        $this->updateAssociatedTask($assignment->task, $this->getTaskRequestDataWithRelations($command));
        $this->updatePolymorphicRelations($assignment, $command->userList, $command->groupList);
    }
}
