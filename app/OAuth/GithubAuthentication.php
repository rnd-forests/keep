<?php namespace Keep\OAuth;

use Keep\Entities\User;
use Keep\Exceptions\InvalidUserException;
use Keep\OAuth\Contracts\OAuthUserListener;

class GithubAuthentication extends AuthenticationProvider {

    /**
     * Authenticate user.
     *
     * @param                   $hasCode
     * @param OAuthUserListener $listener
     *
     * @return mixed
     * @throws InvalidUserException
     */
    public function execute($hasCode, OAuthUserListener $listener)
    {
        $provider = 'github';

        if (!$hasCode) return $this->getAuthorizationUrl($provider);

        $postBackData = $this->handleProviderCallback($provider);

        $user = $this->userRepo->findByUsernameOrCreate($this->getUserProviderData($postBackData), $provider);

        if (!$user) throw new InvalidUserException('Something went wrong with your GitHub authentication process.');

        $this->updateAuthenticatedUser($user, $postBackData);

        $this->auth->login($user, true);

        return $listener->userHasLoggedIn($user);
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
            'location'        => $userData->user['location'],
            'bio'             => $userData->user['bio'],
            'company'         => $userData->user['company'],
            'github_username' => str_replace('https://github.com/', '', $userData->user['html_url'])
        ]);

        return $user->save();
    }

}