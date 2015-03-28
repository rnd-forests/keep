<?php namespace Keep\Providers;

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
        'Keep\Events\UserWasActivatedEvent' => [
            'Keep\Handlers\Events\EmailActivatedAccount',
        ],
        'Keep\Events\TaskWasCreatedEvent' => [
            'Keep\Handlers\Events\EmailNewlyCreatedTask',
        ],
	];

	/**
	 * Register any other events for your application.
	 *
	 * @param  \Illuminate\Contracts\Events\Dispatcher  $events
	 * @return void
	 */
	public function boot(DispatcherContract $events)
	{
		parent::boot($events);
        //
	}

}
