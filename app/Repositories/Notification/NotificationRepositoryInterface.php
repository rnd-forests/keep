<?php namespace Keep\Repositories\Notification;

interface NotificationRepositoryInterface {

    /**
     * Count the number of available notifications.
     *
     * @return mixed
     */
    public function count();

    /**
     * Find a notification by its slug.
     *
     * @param $slug
     *
     * @return mixed
     */
    public function findBySlug($slug);

    /**
     * Create a new notification.
     *
     * @param array $data
     *
     * @return mixed
     */
    public function create(array $data);

    /**
     * Delete a notification.
     *
     * @param $slug
     *
     * @return mixed
     */
    public function delete($slug);

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
    public function fetchPersonalNotifications($userSlug);

    /**
     * Count the number of available notifications of a user.
     *
     * @param $user
     *
     * @return mixed
     */
    public function countUserNotifications($user);

    /**
     * Fetch all old notifications.
     *
     * @return mixed
     */
    public function fetchOldNotifications();

    /**
     * Fetch all group notifications associated with a user.
     *
     * @param $userSlug
     *
     * @return mixed
     */
    public function fetchGroupNotifications($userSlug);

}