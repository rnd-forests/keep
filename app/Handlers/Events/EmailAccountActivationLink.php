<?php
namespace Keep\Handlers\Events;

use App;
use Keep\Mailers\UserMailer;
use Keep\Events\UserWasRegisteredEvent;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class EmailAccountActivationLink implements ShouldBeQueued
{
    /**
     * Handle the event.
     *
     * @param UserWasRegisteredEvent $event
     */
    public function handle(UserWasRegisteredEvent $event)
    {
        $mailer = App::make(UserMailer::class);
        $mailer->sendAccountActivationLink($event->user, $event->user->activation_code);
    }
}
