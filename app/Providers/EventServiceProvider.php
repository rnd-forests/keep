<?php

namespace Keep\Providers;

use Keep\Entities\Observers\UserObserver;
use Keep\Entities\Observers\NotificationObserver;
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
        \Keep\Listeners\UserEventListener::class,
    ];

    /**
     * Register any other events for your application.
     *
     * @param \Illuminate\Contracts\Events\Dispatcher $events
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        \Keep\Entities\User::observe(new UserObserver);
        \Keep\Entities\Notification::observe(new NotificationObserver);
    }
}
