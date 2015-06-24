<?php
namespace Keep\Mailers;

abstract class Mailer
{
    public function sendTo($user, $subject, $view, $data = [])
    {
        $mailer = app()->make('Illuminate\Mail\Mailer');
        $mailer->queue($view, $data, function ($message) use ($user, $subject) {
            $message->to($user->email)->subject($subject);
        });
    }
}
