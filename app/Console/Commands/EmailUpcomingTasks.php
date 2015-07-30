<?php

namespace Keep\Console\Commands;

use Illuminate\Console\Command;
use Keep\Mailers\Contracts\MailerInterface;
use Keep\Repositories\Task\TaskRepositoryInterface as TaskRepo;

class EmailUpcomingTasks extends Command
{
    protected $tasks, $mailer;
    protected $signature = 'keep:email-upcoming-tasks';
    protected $description = 'Email users about their upcoming tasks.';

    /**
     * Create a new command instance.
     *
     * @param TaskRepo $tasks
     * @param MailerInterface $mailer
     */
    public function __construct(TaskRepo $tasks, MailerInterface $mailer)
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
        $this->output->progressStart(counting($upcomingTasks));
        $upcomingTasks->each(function ($task) {
            $this->mailer->emailUpcomingTask($task->user, $task);
            $this->output->progressAdvance();
        });
        $this->output->progressFinish();
        $this->info(trans('console.emailed_upcoming_tasks'));
    }
}
