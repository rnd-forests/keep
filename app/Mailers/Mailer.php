<?php  namespace Keep\Mailers;

use Illuminate\Mail\Mailer as Mail;

abstract class Mailer {

    private $mail;

    /**
     * Constructor.
     *
     * @param Mail $mail
     */
    public function __construct(Mail $mail)
    {
        $this->mail = $mail;
    }

    /**
     * Perform the sending email process.
     *
     * @param       $user
     * @param       $subject
     * @param       $view
     * @param array $data
     */
    public function sendTo($user, $subject, $view, $data = [])
    {
        $this->mail->queue($view, $data, function($message) use ($user, $subject) {
            $message->to($user->email)->subject($subject);
        });
    }

}