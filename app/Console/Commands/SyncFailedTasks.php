<?php

namespace Keep\Console\Commands;

use Illuminate\Console\Command;
use Keep\Repositories\Task\TaskRepositoryInterface;

class SyncFailedTasks extends Command
{
    protected $tasks;
    protected $signature = 'keep:sync-failed-tasks';
    protected $description = 'Find/Recover failed tasks in entire database.';

    /**
     * Create a new command instance.
     *
     * @param TaskRepositoryInterface $tasks
     */
    public function __construct(TaskRepositoryInterface $tasks)
    {
        $this->tasks = $tasks;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->error(plural2('task', 'failed', $this->tasks->findAndUpdateFailedTasks()) . ' found.');
        $this->info(plural2('task', 'failed', $this->tasks->recoverFailedTasks()) . ' recovered.');
    }
}
