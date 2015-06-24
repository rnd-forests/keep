<?php
namespace Keep\Jobs;

use Illuminate\Contracts\Bus\SelfHandling;
use Keep\Jobs\Relations\AssignmentRelations;

class CreateGroupAssignment extends AssignmentRelations implements SelfHandling
{
    /**
     * Create assignment for groups.
     *
     * @return void
     */
    public function handle()
    {
        $assignment = parent::$assignmentRepo->create($this->getAssignmentRequestData());
        $task = parent::$taskRepo->create($this->getTaskRequestData());
        $groups = parent::$groupRepo->fetchGroupsByIds($this->data['group_list']);
        $this->setRelations($assignment, $task, $groups);
    }
}
