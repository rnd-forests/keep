<?php

namespace Keep\OAuth;

use Keep\Entities\User;
use Keep\OAuth\Contracts\ProviderInterface;

class FacebookAuthentication extends AuthenticationProvider implements ProviderInterface
{
    /**
     * Update authenticated user profile.
     *
     * @param User $user
     * @param      $userData
     *
     * @return mixed
     */
    public function updateAuthenticatedUser(User $user, $userData)
    {
        return true;
    }

    /**
     * Get authentication exception message.
     *
     * @return string
     */
    public function getExceptionMessage()
    {
        return trans('authentication.facebook_error');
    }

    /**
     * Get authentication provider name.
     *
     * @return string
     */
    protected function getAuthProvider()
    {
        return 'facebook';
    }
}
