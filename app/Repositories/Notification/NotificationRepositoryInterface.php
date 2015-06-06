<?php
namespace Keep\Repositories\Notification;

use Keep\Entities\User;

interface NotificationRepositoryInterface
{
    public function create(array $data);

    public function delete($slug);

    public function getPaginatedNotifications($limit);

    public function fetchPersonalNotifications($userSlug);

    public function countUserNotifications(User $user);

    public function fetchOldNotifications();

    public function fetchGroupNotifications($userSlug);
}