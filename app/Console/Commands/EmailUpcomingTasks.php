<?php

namespace Keep\Console\Commands;

use Illuminate\Console\Command;
use Keep\Core\Repository\Contracts\TaskRepository;
use Keep\Core\Mailers\Contracts\UserMailerContract;

class EmailUpcomingTasks extends Command
{
    protected $tasks, $mailer;
    protected $signature = 'keep:email-upcoming-tasks';
    protected $description = 'Email users about their upcoming tasks.';

    public function __construct(TaskRepository $tasks, UserMailerContract $mailer)
    {
        parent::__construct();
        $this->tasks = $tasks;
        $this->mailer = $mailer;
    }

    public function handle()
    {
        $upcomingTasks = $this->tasks->upcomingTasks();
        $bar = $this->output->createProgressBar(counting($upcomingTasks));
        $upcomingTasks->each(function ($task) use ($bar) {
            $this->mailer->emailUpcomingTask($task->user, $task);
            $bar->advance();
        });
        $bar->finish();
        $this->info(trans('console.emailed_upcoming_tasks'));
        $this->table(['ID', 'Title'], $this->tasks->upcomingTasksForConsole());
    }
}
