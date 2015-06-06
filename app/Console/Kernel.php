<?php
namespace Keep\Console;

use Illuminate\Console\Scheduling\Schedule;
use Keep\Console\Commands\SyncFailedTasksCommand;
use Keep\Console\Commands\EmailUpcomingTasksCommand;
use Keep\Console\Commands\NotifyUpcomingTasksCommand;
use Keep\Console\Commands\ClearOldNotificationsCommand;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        SyncFailedTasksCommand::class,
        EmailUpcomingTasksCommand::class,
        NotifyUpcomingTasksCommand::class,
        ClearOldNotificationsCommand::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     *
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->exec('composer self-update')
            ->monthly()
            ->withoutOverlapping()
            ->environments('production');

        $schedule->command('keep:sync-failed-tasks')
            ->everyFiveMinutes()
            ->withoutOverlapping()
            ->evenInMaintenanceMode();

        $schedule->command('keep:notify-upcoming-tasks')
            ->weeklyOn(5, '10:00')
            ->withoutOverlapping()
            ->evenInMaintenanceMode();

        $schedule->command('keep:email-upcoming-tasks')
            ->weeklyOn(5, '8:00')
            ->withoutOverlapping()
            ->evenInMaintenanceMode();

        $schedule->command('keep:clear-old-notifications')
            ->dailyAt('1:00')
            ->withoutOverlapping()
            ->evenInMaintenanceMode();
    }
}
