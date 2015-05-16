<?php namespace Keep\Console\Commands;

use Illuminate\Console\Command;
use Keep\Repositories\Notification\NotificationRepositoryInterface;

class ClearOldNotificationsCommand extends Command {

    protected $notificationRepo;

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'keep:clear-old-notifications';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Clear old notifications from the application.';

    /**
     * Create a new command instance.
     *
     * @param NotificationRepositoryInterface $notificationRepo
     */
	public function __construct(NotificationRepositoryInterface $notificationRepo)
	{
		parent::__construct();

        $this->notificationRepo = $notificationRepo;
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
        $oldNotifications = $this->notificationRepo->fetchOldNotifications();

        $oldNotifications->each(function ($notification)
        {
            $this->notificationRepo->delete($notification->slug);
        });

        $this->info('Cleared all old notifications.');
	}

}
