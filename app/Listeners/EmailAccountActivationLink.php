<?php
namespace Keep\Listeners;

use Keep\Mailers\UserMailer;
use Keep\Events\UserHasRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailAccountActivationLink implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  UserHasRegistered $event
     *
     * @return void
     */
    public function handle(UserHasRegistered $event)
    {
        $mailer = app()->make(UserMailer::class);
        $mailer->sendAccountActivationLink($event->user, $event->user->activation_code);
    }
}
