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

        $this->info('-> ' . $updatedRows . ' failed ' . str_plural('task', $updatedRows) . ' found and updated.');
        $this->info('-> ' . $recoveredRows . ' failed ' . str_plural('task', $recoveredRows) . ' recovered.');
    }
}
