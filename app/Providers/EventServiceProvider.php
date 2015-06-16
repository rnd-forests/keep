<?php
namespace Keep\Providers;

use DB;
use Keep\Entities\User;
use Keep\Entities\Task;
use Keep\Entities\Profile;
use Keep\Entities\Assignment;
use Keep\Entities\Notification;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event handler mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        //
    ];

    /**
     * The subscriber classes to register.
     *
     * @var array
     */
    protected $subscribe = [
        \Keep\Listeners\UserEventListener::class
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

        User::created(function ($user) {
            $user->profile()->save(new Profile());
        });

        Task::deleting(function ($task) {
            $task->destroyer_id = auth()->user()->id;
            $task->save();
        });

        Task::restoring(function ($task) {
            $task->destroyer_id = 0;
            $task->save();
        });

        Assignment::deleting(function ($assignment) {
            $assignment->task()->update(['destroyer_id' => auth()->user()->id]);
            $assignment->task()->delete();
        });

        Notification::deleting(function ($notification) {
            DB::table('notifiables')->where('notification_id', $notification->id)->delete();
        });
    }
}
