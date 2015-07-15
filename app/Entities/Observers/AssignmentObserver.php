<?php

namespace Keep\Entities\Observers;

use Keep\Entities\Assignment;

class AssignmentObserver
{
    /**
     * Hook into assignment deleting event.
     *
     * @param Assignment $assignment
     */
    public function deleting(Assignment $assignment)
    {
        $assignment->task()->delete();
    }
}
