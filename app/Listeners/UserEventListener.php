<?php

namespace Keep\Listeners;

use Illuminate\Events\Dispatcher;
use Keep\Events\TaskHasPublished;
use Keep\Events\UserHasRegistered;
use Keep\Mailers\Contracts\MailerInterface;

class UserEventListener
{
    private $mailer;

    /**
     * Constructor.
     *
     * @param MailerInterface $mailer
     */
    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Handler user registration event.
     *
     * @param UserHasRegistered $event
     */
    public function onUserRegister(UserHasRegistered $event)
    {
        $this->mailer->emailAccountActivationUrl($event->user, $event->user->activation_code);
    }

    /**
     * Handle published task event.
     *
     * @param TaskHasPublished $event
     */
    public function onUserScheduleTask(TaskHasPublished $event)
    {
        $this->mailer->emailNewlyCreatedTask($event->user, $event->task);
    }

    /**
     * Subscribe all user events.
     *
     * @param Dispatcher $events
     */
    public function subscribe(Dispatcher $events)
    {
        $events->listen(
            \Keep\Events\UserHasRegistered::class,
            'Keep\Listeners\UserEventListener@onUserRegister'
        );

        $events->listen(
            \Keep\Events\TaskHasPublished::class,
            'Keep\Listeners\UserEventListener@onUserScheduleTask'
        );
    }
}
