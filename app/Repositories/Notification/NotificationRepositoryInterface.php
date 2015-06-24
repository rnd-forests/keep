<?php

namespace Keep\Repositories\Notification;

interface NotificationRepositoryInterface
{
    public function create(array $data);

    public function delete($slug);

    public function fetchPaginatedNotifications($limit);

    public function fetchPersonalNotifications($userSlug);

    public function countUserNotifications($user);

    public function fetchOldNotifications();

    public function fetchGroupNotifications($userSlug);
}
