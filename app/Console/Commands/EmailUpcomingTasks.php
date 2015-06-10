<?php
namespace Keep\Console\Commands;

use Keep\Mailers\UserMailer;
use Illuminate\Console\Command;
use Keep\Repositories\Task\TaskRepositoryInterface;

class EmailUpcomingTasks extends Command
{
    protected $tasks, $mailer;
    protected $signature = 'keep:email-upcoming-tasks';
    protected $description = 'Notify users about their upcoming tasks using their email address.';

    /**
     * Create a new command instance.
     *
     * @param TaskRepositoryInterface $tasks
     * @param UserMailer              $mailer
     */
    public function __construct(TaskRepositoryInterface $tasks,
                                UserMailer $mailer)
    {
        $this->tasks = $tasks;
        $this->mailer = $mailer;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $upcomingTasks = $this->tasks->fetchUserUpcomingTasks();
        $this->output->progressStart($upcomingTasks->count());
        $upcomingTasks->each(function ($task) {
            $this->mailer->sendNotificationAboutUpcomingTask(
                $task->owner, $task
            );
            $this->output->progressAdvance();
        });
        $this->output->progressFinish();
        $this->info('All users have been notified by email about their upcoming tasks.');
    }
}
