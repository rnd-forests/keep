<?php

namespace Keep\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \Keep\Console\Commands\EmailUpcomingTasks::class,
        \Keep\Console\Commands\ClearOldNotifications::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->exec('auth:clear-resets')
            ->weekly()
            ->withoutOverlapping()
            ->environments('production');

        $schedule->command('keep:sync-failed-tasks')
            ->everyMinute()
            ->withoutOverlapping();

        $schedule->command('keep:email-upcoming-tasks')
            ->weeklyOn(5, '8:00')
            ->withoutOverlapping()
            ->evenInMaintenanceMode();

        $schedule->command('keep:clear-old-notifications')
            ->dailyAt('1:00')
            ->withoutOverlapping();
    }
}
