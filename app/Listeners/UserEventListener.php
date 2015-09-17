<?php

namespace Keep\Listeners;

use Illuminate\Events\Dispatcher;
use Keep\Events\TaskHasPublished;
use Keep\Events\UserHasRegistered;
use Keep\Core\Mailers\Contracts\UserMailerContract;

class UserEventListener
{
    private $mailer;

    public function __construct(UserMailerContract $mailer)
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
        $this->mailer->emailActivationLink($event->user, $event->user->activation_code);
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
