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
        $affectedRows = $this->taskRepo->findAndUpdateFailedTasks();

        $this->info('Awesome! ' . $affectedRows . ' failed ' . str_plural('task', $affectedRows) . ' found and updated.');
	}

}
