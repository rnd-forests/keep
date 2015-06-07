<?php
namespace Keep\Console\Commands;

use Illuminate\Console\Command;
use Keep\Repositories\Task\TaskRepositoryInterface;

class SyncFailedTasksCommand extends Command
{
    protected $taskRepo;
    protected $name = 'keep:sync-failed-tasks';
    protected $description = 'Find failed tasks in entire database. Recover failed tasks if available';

    /**
     * Create a new command instance.
     *
     * @param TaskRepositoryInterface $taskRepo
     */
    public function __construct(TaskRepositoryInterface $taskRepo)
    {
        $this->taskRepo = $taskRepo;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $updatedRows = $this->taskRepo->findAndUpdateFailedTasks();
        $recoveredRows = $this->taskRepo->recoverFailedTasks();

        $this->info('-> ' . $updatedRows . ' failed ' . str_plural('task', $updatedRows) . ' found and updated.');
        $this->info('-> ' . $recoveredRows . ' failed ' . str_plural('task', $recoveredRows) . ' recovered.');
    }
}
