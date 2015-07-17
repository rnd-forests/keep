<?php

namespace Keep\OAuth;

use Keep\OAuth\Contracts\OpenAuthenticatable;

class FacebookAuthentication extends OpenAuthentication implements OpenAuthenticatable
{
    /**
     * Get the open authentication provider name.
     *
     * @return string
     */
    public function getAuthenticationProvider()
    {
        return 'facebook';
    }

    /**
     * Get the authentication exception message.
     *
     * @return string
     */
    public function getAuthenticationException()
    {
        return trans('authentication.facebook_error');
    }

    /**
     * Extract and update user profile from data returned from provider.
     *
     * @param $user
     * @param $data
     * @return mixed
     */
    public function extractAndUpdateProfile($user, $data)
    {
        return true;
    }
}
