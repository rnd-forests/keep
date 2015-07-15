<?php

namespace Keep\Mailers\Contracts;

interface MailerInterface
{
    /**
     * Send email to a specific user.
     *
     * @param $user
     * @param $subject
     * @param $view
     * @param array $data
     * @return mixed
     */
    public function sendTo($user, $subject, $view, $data = []);

    /**
     * Send an email with account activation link to user.
     *
     * @param $user
     * @param $code
     * @return mixed
     */
    public function emailAccountActivationUrl($user, $code);

    /**
     * Send an email to notify users about their new tasks.
     *
     * @param $user
     * @param $task
     * @return mixed
     */
    public function emailNewlyCreatedTask($user, $task);

    /**
     * Send an email to notify users about their upcoming tasks.
     *
     * @param $user
     * @param $task
     * @return mixed
     */
    public function emailUpcomingTask($user, $task);
}