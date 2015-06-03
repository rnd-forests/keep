<?php namespace Keep\OAuth;

use Keep\Entities\User;

class GithubAuthentication extends AuthenticationProvider {

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
            'location'        => $userData->user['location'],
            'bio'             => $userData->user['bio'],
            'company'         => $userData->user['company'],
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