<?php namespace Keep\Notifications;

interface NotifiableInterface {

    /**
     * Fetch the notifications.
     *
     * @return mixed
     */
    public function fetch();

}