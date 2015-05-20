<?php namespace Keep\Console\Commands;

use Illuminate\Console\Command;
use Keep\Repositories\Notification\NotificationRepositoryInterface;
use Keep\Repositories\Task\TaskRepositoryInterface;

class NotifyUpcomingTasksCommand extends Command {

    protected $taskRepo, $notificationRepo;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'keep:notify-upcoming-tasks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify users about their upcoming tasks using application notification system';

    /**
     * Create a new command instance.
     *
     * @param TaskRepositoryInterface         $taskRepo
     * @param NotificationRepositoryInterface $notificationRepo
     */
    public function __construct(TaskRepositoryInterface $taskRepo, NotificationRepositoryInterface $notificationRepo)
    {
        parent::__construct();

        $this->taskRepo = $taskRepo;
        $this->notificationRepo = $notificationRepo;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $upcomingTasks = $this->taskRepo->fetchUserUpcomingTasks();

        $upcomingTasks->each(function ($task)
        {
            $notification = $this->notificationRepo->create([
                'subject' => 'You have a new upcoming task',
                'body'    => '',
                'type'    => 'warning',
            ]);

            $notification->update([
                'sent_from'   => 'system',
                'object_id'   => $task->id,
                'object_type' => 'Keep\Entities\Task'
            ]);

            $task->owner->notify($notification);
        });

        $this->info('All possible users have been notified about their upcoming tasks.');
    }

}
