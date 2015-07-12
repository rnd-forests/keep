<?php

namespace Keep\Mailers;

use Keep\Entities\Task;
use Keep\Entities\User;

class UserMailer extends Mailer
{
    /**
     * Send account activation link.
     *
     * @param User $user
     * @param      $activationCode
     */
    public function sendAccountActivationLink(User $user, $activationCode)
    {
        $subject = 'Account Activation';
        $view = 'emails.auth.account_activation';
        $data = ['activationLink' => route('auth::activate', $activationCode)];
        $this->sendTo($user, $subject, $view, $data);
    }

    /**
     * Send notification about newly created task.
     *
     * @param User $user
     * @param Task $task
     */
    public function sendNotificationAboutNewTask(User $user, Task $task)
    {
        $subject = 'Keep - New task notification';
        $view = 'emails.task.new_task';
        $data = [
            'username'      => $user->name,
            'taskTitle'     => $task->title,
            'taskContent'   => $task->content,
            'startingDate'  => short_time($task->starting_date),
            'finishingDate' => short_time($task->finishing_date),
            'taskUrl'       => $task->present()->url($user, $task),
        ];
        $this->sendTo($user, $subject, $view, $data);
    }

    /**
     * Send notification to users about their upcoming task.
     *
     * @param User $user
     * @param Task $task
     */
    public function sendNotificationAboutUpcomingTask(User $user, Task $task)
    {
        $subject = 'Keep - Upcoming task notification';
        $view = 'emails.task.upcoming_task';
        $data = [
            'username'      => $user->name,
            'taskTitle'     => $task->title,
            'taskContent'   => $task->content,
            'startingDate'  => short_time($task->starting_date),
            'finishingDate' => short_time($task->finishing_date),
            'remainingDays' => remaining_days($task->finishing_date),
            'taskUrl'       => $task->present()->url($user, $task),
        ];
        $this->sendTo($user, $subject, $view, $data);
    }
}
