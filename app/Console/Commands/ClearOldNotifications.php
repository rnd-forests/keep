<?php

namespace Keep\Console\Commands;

use Illuminate\Console\Command;
use Keep\Repositories\Contracts\NotificationRepository;

class ClearOldNotifications extends Command
{
    protected $notifications;
    protected $signature = 'keep:clear-old-notifications';
    protected $description = 'Clear old notifications.';

    public function __construct(NotificationRepository $notifications)
    {
        parent::__construct();
        $this->notifications = $notifications;
    }

    public function handle()
    {
        $oldNotifications = $this->notifications->oldNotifications();
        $bar = $this->output->createProgressBar(counting($oldNotifications));
        $oldNotifications->each(function ($notification) use ($bar) {
            $this->notifications->delete($notification->slug);
            $bar->advance();
        });
        $bar->finish();
        $this->info(trans('console.cleared_old_notification'));
    }
}
