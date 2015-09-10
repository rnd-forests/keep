<?php

namespace Keep\Events;

use Keep\Entities\Task;
use Keep\Entities\User;
use Illuminate\Queue\SerializesModels;

class TaskHasPublished extends AbstractEvent
{
    use SerializesModels;

    public $user;
    public $task;

    public function __construct(User $user, Task $task)
    {
        $this->user = $user;
        $this->task = $task;
    }
}
