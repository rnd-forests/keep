<?php
namespace Keep\Console\Commands;

use Illuminate\Console\Command;
use Keep\Repositories\Task\TaskRepositoryInterface;

class SyncFailedTasks extends Command
{
    protected $tasks;
    protected $signature = 'keep:sync-failed-tasks';
    protected $description = 'Find failed tasks in entire database. Recover failed tasks if available.';

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
        $updatedRows = $this->tasks->findAndUpdateFailedTasks();
        $recoveredRows = $this->tasks->recoverFailedTasks();

        $this->info('-> ' . plural2('task', 'failed', $updatedRows) . ' found and updated.');
        $this->info('-> ' . plural2('task', 'failed', $recoveredRows) . ' recovered.');
    }
}
