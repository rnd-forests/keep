<?php namespace Keep\Events;

use Keep\Task;
use Keep\User;
use Illuminate\Queue\SerializesModels;

class TaskWasCreatedEvent extends Event {

    use SerializesModels;

    protected $user, $task;

    public function __construct(User $user, Task $task)
    {
        $this->user = $user;
        $this->task = $task;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getTask()
    {
        return $this->task;
    }

}
