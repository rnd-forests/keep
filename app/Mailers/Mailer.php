<?php namespace Keep\Mailers;

use App;

abstract class Mailer {

    /**
     * Perform the sending email process.
     *
     * @param       $user
     * @param       $subject
     * @param       $view
     * @param array $data
     *
     * @return      mixed
     */
    public function sendTo($user, $subject, $view, $data = array())
    {
        $mailer = App::make('Illuminate\Mail\Mailer');

        $mailer->queue($view, $data, function ($message) use ($user, $subject)
        {
            $message->to($user->email)->subject($subject);
        });
    }

}