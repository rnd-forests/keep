<?php

namespace Keep\OAuth;

use Keep\OAuth\Contracts\OpenAuthenticatable;

class GoogleAuthentication extends AbstractOAuth implements OpenAuthenticatable
{
    /**
     * Get the open authentication provider name.
     *
     * @return string
     */
    public function getAuthenticationProvider()
    {
        return 'google';
    }

    /**
     * Get the authentication exception message.
     *
     * @return string
     */
    public function getAuthenticationException()
    {
        return trans('authentication.google_error');
    }

    /**
     * Extract and update user profile from data returned from provider.
     *
     * @param $user
     * @param $data
     * @return mixed
     */
    public function extractAndUpdate($user, $data)
    {
        return $user->profile()->update([
            'bio'             => strip_tags($data->user['aboutMe']),
            'location'        => $data->user['placesLived'][0]['value'],
            'google_username' => str_replace('https://plus.google.com/', '', $data->user['url']),
        ]);
    }
}
