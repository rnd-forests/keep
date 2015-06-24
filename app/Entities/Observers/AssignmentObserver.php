<?php

namespace Keep\Entities\Observers;

use Keep\Entities\Assignment;

class AssignmentObserver
{
    public function deleting(Assignment $assignment)
    {
        $assignment->task()->update([
            'destroyer_id' => auth()->user()->getAuthIdentifier(),
        ]);
        $assignment->task()->delete();
    }

    public function restoring(Assignment $assignment)
    {
        $assignment->task()->update([
            'destroyer_id' => null,
        ]);
    }
}
