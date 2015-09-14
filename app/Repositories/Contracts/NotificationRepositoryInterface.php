<?php

namespace Keep\Repositories\Contracts;

interface NotificationRepositoryInterface
{
    public function delete($slug);
    public function personalNotifications($userSlug);
    public function groupNotifications($userSlug);
    public function oldNotifications();
}
