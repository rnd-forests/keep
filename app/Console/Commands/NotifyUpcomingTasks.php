<?php

namespace Keep\Console\Commands;

use Illuminate\Console\Command;
use Keep\Repositories\Task\TaskRepositoryInterface;
use Keep\Repositories\Notification\NotificationRepositoryInterface;

class NotifyUpcomingTasks extends Command
{
    protected $tasks, $notifications;
    protected $signature = 'keep:notify-upcoming-tasks';
    protected $description = 'Notify users about their upcoming tasks using application notification system.';

    /**
     * Create a new command instance.
     *
     * @param TaskRepositoryInterface         $tasks
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
        $this->output->progressStart($upcomingTasks->count());
        $upcomingTasks->each(function ($task) {
            $notification = $this->notifications->create([
                'subject' => 'You have a new upcoming task',
                'body' => '',
                'type' => 'warning',
            ]);
            $notification->update([
                'sent_from' => 'application',
                'object_id' => $task->id,
                'object_type' => 'Keep\Entities\Task',
            ]);
            $notification->save();
            $task->owner->notify($notification);
            $this->output->progressAdvance();
        });
        $this->output->progressFinish();
        $this->info('All possible users have been notified about their upcoming tasks.');
    }
}
