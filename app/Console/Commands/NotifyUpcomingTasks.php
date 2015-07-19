<?php

namespace Keep\Console\Commands;

use Illuminate\Console\Command;
use Keep\Repositories\Task\TaskRepositoryInterface;
use Keep\Repositories\Notification\NotificationRepositoryInterface;

class NotifyUpcomingTasks extends Command
{
    protected $tasks, $notifications;
    protected $signature = 'keep:notify-upcoming-tasks';
    protected $description = 'Notify users about their upcoming tasks.';

    /**
     * Create a new command instance.
     *
     * @param TaskRepositoryInterface $tasks
     * @param NotificationRepositoryInterface $notifications
     */
    public function __construct(TaskRepositoryInterface $tasks,
                                NotificationRepositoryInterface $notifications)
    {
        $this->tasks = $tasks;
        $this->notifications = $notifications;
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
            $this->notifyTask($task);
            $this->output->progressAdvance();
        });
        $this->output->progressFinish();
        $this->info('Notified all upcoming tasks.');
    }

    /**
     * Notifying upcoming task.
     *
     * @param $task
     */
    protected function notifyTask($task)
    {
        $notification = $this->notifications->create([
            'subject' => 'Upcoming task',
            'body'    => '',
            'type'    => 'warning'
        ]);
        $notification->update([
            'sent_from'   => 'application',
            'object_id'   => $task->id,
            'object_type' => 'Keep\Entities\Task'
        ]);
        $task->user->notify($notification);
    }
}
