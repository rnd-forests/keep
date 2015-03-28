<?php namespace Keep\Handlers\Events;

use Keep\Mailers\UserMailer;
use Keep\Events\UserWasRegisteredEvent;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class EmailAccountActivationLink implements ShouldBeQueued {

    protected $mailer;

    /**
     * Event handler constructor.
     *
     * @param UserMailer $mailer
     */
	public function __construct(UserMailer $mailer)
	{
		$this->mailer = $mailer;
	}

    /**
     * Handle the event.
     *
     * @param UserWasRegisteredEvent $event
     */
	public function handle(UserWasRegisteredEvent $event)
	{
		$this->mailer->sendAccountActivationLink($event->getUser(), $event->getUser()->activation_code);
	}

}
