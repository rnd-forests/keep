<?php namespace Keep\Console\Commands;

use Keep\Mailers\UserMailer;
use Illuminate\Console\Command;
use Keep\Repositories\Task\TaskRepositoryInterface;

class NotifyUpcomingTasksUsingEmailCommand extends Command {

    protected $taskRepo, $mailer;

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'keep:notify-upcoming-tasks-using-email';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Notify users about their upcoming tasks using their email address';

    /**
     * Create a new command instance.
     *
     * @param TaskRepositoryInterface $taskRepo
     * @param UserMailer              $mailer
     */
	public function __construct(TaskRepositoryInterface $taskRepo, UserMailer $mailer)
	{
		parent::__construct();

        $this->taskRepo = $taskRepo;
        $this->mailer = $mailer;
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$upcomingTasks = $this->taskRepo->fetchUserUpcomingTasks();

        $upcomingTasks->each(function($task)
        {
            $this->mailer->sendNotificationAboutUpcomingTask($task->owner, $task);
        });

        $this->info('All emails have been sent to users to notify them about their upcoming tasks.');
	}

}
