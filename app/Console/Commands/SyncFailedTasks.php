<?php

namespace Keep\Console\Commands;

use Illuminate\Console\Command;
use Keep\Repositories\Contracts\TaskRepositoryInterface as TaskRepository;

class SyncFailedTasks extends Command
{
    protected $tasks;
    protected $signature = 'keep:sync-failed-tasks';
    protected $description = 'Find/Recover failed tasks in entire database.';

    public function __construct(TaskRepository $tasks)
    {
        $this->tasks = $tasks;
        parent::__construct();
    }

    public function handle()
    {
        $this->error(plural2('task', 'failed', $this->tasks->findAndUpdateFailedTasks()).' found.');
        $this->info(plural2('task', 'failed', $this->tasks->recoverFailedTasks()).' recovered.');
    }
}
