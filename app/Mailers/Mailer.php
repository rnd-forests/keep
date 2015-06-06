<?php
namespace Keep\Mailers;

use App;

abstract class Mailer
{
    public function sendTo($user, $subject, $view, $data = [])
    {
        $mailer = App::make('Illuminate\Mail\Mailer');
        $mailer->queue($view, $data, function ($message) use ($user, $subject) {
            $message->to($user->email)->subject($subject);
        });
    }
}