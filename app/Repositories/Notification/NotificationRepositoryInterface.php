<?php namespace Keep\Repositories\Notification;

interface NotificationRepositoryInterface {

    /**
     * Count the number of available notifications.
     *
     * @return mixed
     */
    public function count();

    /**
     * Create a new notification.
     *
     * @param array $data
     *
     * @return mixed
     */
    public function create(array $data);

    /**
     * Get the paginated collection of all notifications.
     *
     * @param $limit
     *
     * @return mixed
     */
    public function getPaginatedNotifications($limit);

    /**
     * Fetch all notifications associated with a user.
     *
     * @param $userSlug
     *
     * @return mixed
     */
    public function fetchAll($userSlug);

    /**
     * Count the number of available notifications of a user.
     *
     * @param $user
     *
     * @return mixed
     */
    public function countUserNotifications($user);

}