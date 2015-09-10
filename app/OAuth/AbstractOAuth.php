<?php

namespace Keep\OAuth;

use Keep\Exceptions\InvalidUserException;
use Keep\OAuth\Contracts\OAuthUserListener;
use Keep\OAuth\Contracts\ExtractableProvider;
use Laravel\Socialite\Contracts\Factory as Socialite;
use Laravel\Socialite\Contracts\User as SocialiteUser;
use Keep\Repositories\User\UserRepositoryInterface as UserRepository;

abstract class AbstractOAuth implements ExtractableProvider
{
    protected $users, $socialite;

    public function __construct(UserRepository $users, Socialite $socialite)
    {
        $this->users = $users;
        $this->socialite = $socialite;
    }

    /**
     * Authenticate the user.
     *
     * @param $hasCode
     * @param $provider
     * @param $message
     * @param OAuthUserListener $listener
     * @return mixed
     * @throws InvalidUserException
     */
    public function authenticate($hasCode, $provider, $message, OAuthUserListener $listener)
    {
        if (!$hasCode) {
            return $this->getAuthorizationUrl($provider);
        }
        $data = $this->handleProviderCallback($provider);
        $user = $this->users->findOrCreateNew($this->getUserProviderData($data), $provider);
        if (!$user) {
            throw new InvalidUserException($message);
        }
        $this->extractAndUpdate($user, $data);
        auth()->login($user, true);

        return $listener->userHasLoggedIn($user);
    }

    /**
     * Get the provider authorization URL.
     *
     * @param $provider
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    protected function getAuthorizationUrl($provider)
    {
        return $this->socialite->driver($provider)->redirect();
    }

    /**
     * Handler provider callback.
     *
     * @param $provider
     * @return SocialiteUser
     */
    protected function handleProviderCallback($provider)
    {
        return $this->socialite->driver($provider)->user();
    }

    /**
     * Get data from provider returned information.
     *
     * @param SocialiteUser $data
     * @return array
     */
    protected function getUserProviderData(SocialiteUser $data)
    {
        return [
            'auth_provider_id' => $data->getId(),
            'name'             => $data->getName(),
            'email'            => $data->getEmail(),
        ];
    }
}
