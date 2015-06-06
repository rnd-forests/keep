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
    function updateAuthenticatedUser(User $user, $userData)
    {
        return true;
    }

    /**
     * Get authentication exception message.
     *
     * @return string
     */
    function getExceptionMessage()
    {
        return 'Something went wrong with your Facebook authentication process.';
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