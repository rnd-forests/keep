<?php
namespace Keep\Jobs;

use Illuminate\Contracts\Bus\SelfHandling;
use Keep\Jobs\Templates\AssignmentTemplate;

class CreateMemberAssignment extends AssignmentTemplate implements SelfHandling
{
    /**
     * Create assignment for members.
     */
    public function handle()
    {
        $assignment = parent::$assignmentRepo->create($this->getAssignmentRequestData());
        $task = parent::$taskRepo->create($this->getTaskRequestData());
        $users = parent::$userRepo->fetchUsersByIds($this->data['user_list']);
        $this->setRelations($assignment, $task, $users);
    }
}
