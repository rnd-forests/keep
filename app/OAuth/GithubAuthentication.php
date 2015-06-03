<?php namespace Keep\OAuth;

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
        if (! $hasCode) return $this->getAuthorizationUrl('github');

        $user = $this->userRepo->findByUsernameOrCreate($this->getProviderData(), 'github');

        if (! $user) throw new InvalidUserException('Something went wrong with your GitHub authentication process.');

        $this->auth->login($user, true);

        return $listener->userHasLoggedIn($user);
    }

    /**
     * Get data from provider returned information.
     *
     * @return array
     */
    public function getProviderData()
    {
        $user = $this->handleProviderCallback('github');

        return [
            'auth_provider_id' => $user->getId(),
            'name' => $user->getName(),
            'email' => $user->getEmail(),
        ];
    }

}