<?php namespace Keep\Console\Commands;

use Illuminate\Console\Command;
use Keep\Repositories\Task\TaskRepositoryInterface;

class FailedTasksCommand extends Command {

    protected $taskRepo;

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'keep:failed_tasks';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Find failed tasks in entire database.';

    /**
     * Create a new command instance.
     *
     * @param TaskRepositoryInterface $taskRepo
     */
	public function __construct(TaskRepositoryInterface $taskRepo)
	{
		parent::__construct();

        $this->taskRepo = $taskRepo;
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
