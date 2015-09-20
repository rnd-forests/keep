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
        $this->notifications = $notifications;
        parent::__construct();
    }

    public function handle()
    {
        $oldNotifications = $this->notifications->oldNotifications();
        $this->output->progressStart(counting($oldNotifications));
        $oldNotifications->each(function ($notification) {
            $this->notifications->delete($notification->slug);
            $this->output->progressAdvance();
        });
        $this->output->progressFinish();
        $this->info(trans('console.cleared_old_notification'));
    }
}
