<?php

namespace Keep\Core\OAuth;

use Keep\Core\OAuth\Contracts\OpenAuthenticatable;

class GithubAuthentication extends AbstractOAuth implements OpenAuthenticatable
{
    /**
     * Get the open authentication provider name.
     *
     * @return string
     */
    public function getAuthenticationProvider()
    {
        return 'github';
    }

    /**
     * Get the authentication exception message.
     *
     * @return string
     */
    public function getAuthenticationException()
    {
        return trans('authentication.github_error');
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
            'bio'             => $data->user['bio'],
            'company'         => $data->user['company'],
            'location'        => $data->user['location'],
            'github_username' => str_replace('https://github.com/', '', $data->user['html_url']),
        ]);
    }
}
