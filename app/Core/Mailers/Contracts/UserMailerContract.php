<?php

namespace Keep\Core\Mailers\Contracts;

interface UserMailerContract
{
    /**
     * Send an email with account activation link to user.
     *
     * @param $user
     * @param $code
     * @return mixed
     */
    public function emailActivationLink($user, $code);

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
