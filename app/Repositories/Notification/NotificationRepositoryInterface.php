<?php namespace Keep\Repositories\Notification;

interface NotificationRepositoryInterface {

    /**
     * Create a new notification.
     *
     * @param array $data
     *
     * @return mixed
     */
    public function create(array $data);

    /**
     * Fetch all notifications associated with a user.
     *
     * @param $userSlug
     *
     * @return mixed
     */
    public function fetchAll($userSlug);

}