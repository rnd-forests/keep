<?php

namespace Keep\Jobs;

use Illuminate\Contracts\Bus\SelfHandling;
use Keep\Jobs\Relations\AssignmentRelations;

class ModifyAssignment extends AssignmentRelations implements SelfHandling
{
    /**
     * Modify assignment.
     */
    public function handle()
    {
        $assignment = parent::$assignmentRepo->update(
            $this->getAssignmentSlug(),
            $this->getAssignmentRequestData()
        );
        $this->updateAssociatedTask($assignment->task);
        $this->updatePolymorphicRelations($assignment);
    }
}
