<?php
namespace Keep\Listeners;

use Keep\Mailers\UserMailer;
use Keep\Events\TaskHasPublished;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailNewlyCreatedTask implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  TaskHasPublished $event
     *
     * @return void
     */
    public function handle(TaskHasPublished $event)
    {
        $mailer = app()->make(UserMailer::class);
        $mailer->sendNotificationAboutNewTask($event->user, $event->task);
    }
}
