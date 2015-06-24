<?php
namespace Keep\Listeners;

use Keep\Mailers\UserMailer;
use Illuminate\Events\Dispatcher;
use Keep\Events\TaskHasPublished;
use Keep\Events\UserHasRegistered;

class UserEventListener
{
    private $mailer;

    /**
     * Constructor.
     *
     * @param UserMailer $mailer
     */
    public function __construct(UserMailer $mailer)
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
        $this->mailer->sendAccountActivationLink(
            $event->user,
            $event->user->activation_code
        );
    }

    /**
     * Handle published task event.
     *
     * @param TaskHasPublished $event
     */
    public function onUserScheduleTask(TaskHasPublished $event)
    {
        $this->mailer->sendNotificationAboutNewTask(
            $event->user,
            $event->task
        );
    }

    /**
     * Subscribe all user events.
     *
     * @param Dispatcher $events
     */
    public function subscribe(Dispatcher $events)
    {
        $events->listen(
            'Keep\Events\UserHasRegistered',
            'Keep\Listeners\UserEventListener@onUserRegister'
        );

        $events->listen(
            'Keep\Events\TaskHasPublished',
            'Keep\Listeners\UserEventListener@onUserScheduleTask'
        );
    }
}
