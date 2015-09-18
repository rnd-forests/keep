<?php

namespace Keep\Repositories\Contracts;

interface NotificationRepositoryInterface
{
    /**
     * Delete a notification.
     *
     * @param $slug
     *
     * @return mixed
     */
    public function delete($slug);

    /**
     * Fetching personal notifications of a user.
     *
     * @param $user
     *
     * @return mixed
     */
    public function personalNotificationsFor($user);

    /**
     * Fetching joined group notifications of a user.
     *
     * @param $user
     *
     * @return mixed
     */
    public function groupNotificationsFor($user);

    /**
     * Fetching old notifications.
     *
     * @return mixed
     */
    public function oldNotifications();
}
