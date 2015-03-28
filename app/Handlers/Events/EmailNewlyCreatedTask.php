<?php  namespace Keep\Handlers\Events;

use Keep\Mailers\UserMailer;
use Keep\Events\TaskWasCreatedEvent;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class EmailNewlyCreatedTask implements ShouldBeQueued {

    protected $mailer;

    /**
     * Event handler constructor.
     *
     * @param UserMailer $mailer
     */
    function __construct(UserMailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Handle the event.
     *
     * @param TaskWasCreatedEvent $event
     */
    public function handle(TaskWasCreatedEvent $event)
    {
        $this->mailer->sendNotificationAboutNewTask($event->getUser(), $event->getTask());
    }

}
