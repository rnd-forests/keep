<?php

namespace Keep\Repositories\Contracts;

interface NotificationRepositoryInterface
{
    /**
     * Delete a notification.
     *
     * @param $slug
     * @return mixed
     */
    public function delete($slug);

    /**
     * Fetching personal notifications of a user.
     *
     * @param $userSlug
     * @return mixed
     */
    public function personalNotifications($userSlug);

    /**
     * Fetching joined group notifications of a user.
     *
     * @param $userSlug
     * @return mixed
     */
    public function groupNotifications($userSlug);

    /**
     * Fetching old notifications.
     *
     * @return mixed
     */
    public function oldNotifications();
}
