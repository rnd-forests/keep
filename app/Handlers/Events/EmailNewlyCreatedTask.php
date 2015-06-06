<?php
namespace Keep\Handlers\Events;

use App;
use Keep\Mailers\UserMailer;
use Keep\Events\TaskWasCreatedEvent;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class EmailNewlyCreatedTask implements ShouldBeQueued
{
    /**
     * Handle the event.
     *
     * @param TaskWasCreatedEvent $event
     */
    public function handle(TaskWasCreatedEvent $event)
    {
        $mailer = App::make(UserMailer::class);
        $mailer->sendNotificationAboutNewTask($event->user, $event->task);
    }
}
