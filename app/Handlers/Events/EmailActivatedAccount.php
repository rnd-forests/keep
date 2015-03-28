<?php namespace Keep\Handlers\Events;

use Keep\Mailers\UserMailer;
use Keep\Events\UserWasActivatedEvent;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class EmailActivatedAccount implements ShouldBeQueued {

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
	 * @param  UserWasActivatedEvent  $event
	 * @return void
	 */
	public function handle(UserWasActivatedEvent $event)
	{
        $this->mailer->sendAccountActivatedConfirmation($event->getUser());
	}

}
