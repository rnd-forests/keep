<?php namespace Keep\Providers;

use DB;
use Auth;
use Keep\Task;
use Keep\Assignment;
use Keep\Notification;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider {

    /**
     * The event handler mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'Keep\Events\UserWasRegisteredEvent' => [
            'Keep\Handlers\Events\EmailAccountActivationLink',
        ],
        'Keep\Events\UserWasActivatedEvent'  => [
            'Keep\Handlers\Events\EmailActivatedAccount',
        ],
        'Keep\Events\TaskWasCreatedEvent'    => [
            'Keep\Handlers\Events\EmailNewlyCreatedTask',
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher $events
     *
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        Task::deleting(function ($task)
        {
            $task->destroyer_id = Auth::user()->id;
            $task->save();
        });

        Task::restoring(function ($task)
        {
            $task->destroyer_id = 0;
            $task->save();
        });

        Assignment::deleting(function ($assignment)
        {
            $assignment->task()->forceDelete();
            DB::table('assignables')->where('assignment_id', $assignment->id)->delete();
        });

        Notification::deleting(function ($notification)
        {
            DB::table('notifiables')->where('notification_id', $notification->id)->delete();
        });
    }

}
