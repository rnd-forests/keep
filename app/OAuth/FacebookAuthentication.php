<?php namespace Keep\OAuth;

use Keep\Entities\User;

class FacebookAuthentication extends AuthenticationProvider {

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

}