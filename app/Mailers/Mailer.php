<?php

namespace Keep\Mailers;

use Keep\Mailers\Contracts\MailerInterface;

class Mailer implements MailerInterface
{
    public function sendTo($user, $subject, $view, $data = [])
    {
        $mailer = app('Illuminate\Mail\Mailer');
        $mailer->queue($view, $data, function ($message) use ($user, $subject) {
            $message->to($user->email)->subject($subject);
        });
    }

    public function emailAccountActivationUrl($user, $code)
    {
        $subject = 'Account Activation';
        $view = 'emails.auth.account_activation';
        $data = ['activationLink' => route('auth::activate', $code)];
        $this->sendTo($user, $subject, $view, $data);
    }

    public function emailNewlyCreatedTask($user, $task)
    {
        $subject = 'Newly Created Task';
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

    public function emailUpcomingTask($user, $task)
    {
        $subject = 'Upcoming Task';
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
