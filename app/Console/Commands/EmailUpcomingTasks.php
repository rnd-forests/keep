<?php

namespace Keep\Console\Commands;

use Illuminate\Console\Command;
use Keep\Core\Mailers\Contracts\UserMailerContract;
use Keep\Repositories\Contracts\TaskRepositoryInterface as TaskRepository;

class EmailUpcomingTasks extends Command
{
    protected $tasks, $mailer;
    protected $signature = 'keep:email-upcoming-tasks';
    protected $description = 'Email users about their upcoming tasks.';

    public function __construct(TaskRepository $tasks, UserMailerContract $mailer)
    {
        $this->tasks = $tasks;
        $this->mailer = $mailer;
        parent::__construct();
    }

    public function handle()
    {
        $upcomingTasks = $this->tasks->upcomingTasks();
        $this->output->progressStart(counting($upcomingTasks));
        $upcomingTasks->each(function ($task) {
            $this->mailer->emailUpcomingTask($task->user, $task);
            $this->output->progressAdvance();
        });
        $this->output->progressFinish();
        $this->info(trans('console.emailed_upcoming_tasks'));
    }
}
