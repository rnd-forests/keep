<?php

namespace Keep\Core\Mailers;

abstract class AbstractMailer
{
    /**
     * A generic method to send email throughout application.
     *
     * @param $user
     * @param $subject
     * @param $view
     * @param array $data
     */
    public function sendTo($user, $subject, $view, $data = [])
    {
        $mailer = app('Illuminate\Mail\Mailer');
        $mailer->queue($view, $data, function ($message) use ($user, $subject) {
            $message->to($user->email)->subject($subject);
        });
    }
}
