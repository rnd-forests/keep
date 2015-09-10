<?php

namespace Keep\Mailers;

use Keep\Mailers\Contracts\UserMailerContract;

class UserMailer extends AbstractMailer implements UserMailerContract
{
    /**
     * Send an email with account activation link to user.
     *
     * @param $user
     * @param $code
     * @return mixed
     */
    public function emailActivationLink($user, $code)
    {
        $subject = trans('mailer.account_activation_subject');
        $view = 'emails.auth.account_activation';
        $data = ['activationLink' => route('auth::activate', $code)];
        $this->sendTo($user, $subject, $view, $data);
    }

    /**
     * Send an email to notify users about their new tasks.
     *
     * @param $user
     * @param $task
     * @return mixed
     */
    public function emailNewlyCreatedTask($user, $task)
    {
        $subject = trans('mailer.new_task_subject');
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
     * Send an email to notify users about their upcoming tasks.
     *
     * @param $user
     * @param $task
     * @return mixed
     */
    public function emailUpcomingTask($user, $task)
    {
        $subject = trans('mailer.upcoming_task_subject');
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
