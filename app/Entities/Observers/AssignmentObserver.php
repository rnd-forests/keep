<?php

namespace Keep\Entities\Observers;

use Keep\Entities\Assignment;

class AssignmentObserver
{
    public function deleting(Assignment $assignment)
    {
        $assignment->task()->delete();
    }
}
