<?php

namespace Keep\Console\Commands;

use Illuminate\Console\Command;
use Keep\Repositories\Notification\NotificationRepositoryInterface;

class ClearOldNotifications extends Command
{
    protected $notifications;
    protected $signature = 'keep:clear-old-notifications';
    protected $description = 'Clear old notifications from the application.';

    /**
     * Create a new command instance.
     *
     * @param NotificationRepositoryInterface $notifications
     */
    public function __construct(NotificationRepositoryInterface $notifications)
    {
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
        $oldNotifications = $this->notifications->fetchOldNotifications();
        $this->output->progressStart(counting($oldNotifications));
        $oldNotifications->each(function ($notification) {
            $this->notifications->delete($notification->slug);
            $this->output->progressAdvance();
        });
        $this->output->progressFinish();
        $this->info('All old notifications were cleared.');
    }
}
