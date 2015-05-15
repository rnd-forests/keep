<?php namespace Keep\Repositories\Notification;

interface NotificationRepositoryInterface {

    /**
     * Fetch all notifications associated with a user.
     *
     * @param $userSlug
     *
     * @return mixed
     */
    public function fetchAll($userSlug);

}