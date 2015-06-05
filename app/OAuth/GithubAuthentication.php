<?php namespace Keep\OAuth;

use Keep\Entities\User;
use Keep\OAuth\Contracts\ProviderInterface;

class GithubAuthentication extends AuthenticationProvider implements ProviderInterface {

    /**
     * Get authentication provider name.
     *
     * @return string
     */
    protected function getAuthProvider()
    {
        return 'github';
    }

    /**
     * Update authenticated user profile.
     *
     * @param User $user
     * @param      $userData
     *
     * @return bool
     */
    function updateAuthenticatedUser(User $user, $userData)
    {
        $user->profile()->update([
            'bio'             => $userData->user['bio'],
            'company'         => $userData->user['company'],
            'location'        => $userData->user['location'],
            'github_username' => str_replace('https://github.com/', '', $userData->user['html_url'])
        ]);

        return $user->save();
    }

    /**
     * Get authentication exception message.
     *
     * @return string
     */
    function getExceptionMessage()
    {
        return 'Something went wrong with your GitHub authentication process.';
    }

}