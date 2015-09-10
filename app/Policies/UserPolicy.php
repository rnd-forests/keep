<?php

namespace Keep\Policies;

use Keep\Entities\User;

class UserPolicy
{
    public function __construct()
    {
    }

    public function updateAccountAndProfile(User $authenticatedUser, User $accessingUser)
    {
        return $authenticatedUser->id === $accessingUser->id;
    }
}
