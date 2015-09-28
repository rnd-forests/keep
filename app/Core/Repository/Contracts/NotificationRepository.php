<?php

namespace Keep\Core\Repository\Contracts;

interface NotificationRepository
{
    /**
     * Delete a notification.
     *
     * @param $slug
     * @return bool|null
     */
    public function delete($slug);

    /**
     * Fetching personal notifications of a user.
     *
     * @param $user
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function personalNotificationsFor($user);

    /**
     * Fetching joined group notifications of a user.
     *
     * @param $user
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function groupNotificationsFor($user);

    /**
     * Fetching old notifications.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function oldNotifications();
}
