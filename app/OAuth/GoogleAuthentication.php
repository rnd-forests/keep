<?php namespace Keep\OAuth;

use Keep\Entities\User;
use Keep\OAuth\Contracts\ProviderInterface;

class GoogleAuthentication extends AuthenticationProvider implements ProviderInterface {

    /**
     * Get authentication provider name.
     *
     * @return string
     */
    protected function getAuthProvider()
    {
        return 'google';
    }

    /**
     * Update authenticated user profile.
     *
     * @param User $user
     * @param      $userData
     *
     * @return mixed
     */
    protected function updateAuthenticatedUser(User $user, $userData)
    {
        $user->profile()->update([
            'bio'                  => strip_tags($userData->user['aboutMe']),
            'location'             => $userData->user['placesLived'][0]['value'],
            'google_plus_username' => str_replace('https://plus.google.com/', '', $userData->user['url'])
        ]);

        return $user->save();
    }

    /**
     * Get authentication exception message.
     *
     * @return string
     */
    protected function getExceptionMessage()
    {
        return 'Something went wrong with your Google authentication process.';
    }

}