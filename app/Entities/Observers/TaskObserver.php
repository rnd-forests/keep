<?php
namespace Keep\Entities\Observers;

use Keep\Entities\Task;

class TaskObserver
{
    public function deleting(Task $task)
    {
        $task->update([
            'destroyer_id' => auth()->user()->getAuthIdentifier()
        ]);
    }

    public function restoring(Task $task)
    {
        $task->update([
            'destroyer_id' => null
        ]);
    }
}
