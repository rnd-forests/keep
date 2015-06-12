<?php
namespace Keep\OAuth;

use Keep\Entities\User;
use Keep\Exceptions\InvalidUserException;
use Keep\OAuth\Contracts\OAuthUserListener;
use Keep\Repositories\User\UserRepositoryInterface;
use Laravel\Socialite\Contracts\Factory as Socialite;
use Laravel\Socialite\Contracts\User as SocialiteUser;

abstract class AuthenticationProvider
{
    protected $userRepo, $socialite;

    /**
     * Constructor.
     *
     * @param UserRepositoryInterface $userRepo
     * @param Socialite               $socialite
     */
    public function __construct(UserRepositoryInterface $userRepo, Socialite $socialite)
    {
        $this->userRepo = $userRepo;
        $this->socialite = $socialite;
    }

    /**
     * Authenticate user.
     *
     * @param                   $hasCode
     * @param OAuthUserListener $listener
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws InvalidUserException
     */
    public final function authenticate($hasCode, OAuthUserListener $listener)
    {
        $provider = $this->getAuthProvider();
        if ( ! $hasCode) {
            return $this->getAuthorizationUrl($provider);
        }
        $providerData = $this->handleProviderCallback($provider);
        $user = $this->userRepo->findOrCreateNew(
            $this->getUserProviderData($providerData),
            $provider
        );
        if ( ! $user) {
            throw new InvalidUserException($this->getExceptionMessage());
        }
        $this->updateAuthenticatedUser($user, $providerData);
        auth()->login($user, true);

        return $listener->userHasLoggedIn($user);
    }

    /**
     * Get the provider authorization URL.
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    protected final function getAuthorizationUrl()
    {
        return $this->socialite->driver($this->getAuthProvider())->redirect();
    }

    /**
     * Handler provider callback.
     *
     * @return \Laravel\Socialite\Contracts\User
     */
    protected final function handleProviderCallback()
    {
        return $this->socialite->driver($this->getAuthProvider())->user();
    }

    /**
     * Get data from provider returned information.
     *
     * @param $providerData
     *
     * @return array
     */
    protected final function getUserProviderData(SocialiteUser $providerData)
    {
        return [
            'auth_provider_id' => $providerData->getId(),
            'name'             => $providerData->getName(),
            'email'            => $providerData->getEmail(),
        ];
    }

    /**
     * Get authentication provider name.
     *
     * @return string
     */
    protected abstract function getAuthProvider();

    /**
     * Update authenticated user profile.
     *
     * @param User $user
     * @param      $userData
     *
     * @return mixed
     */
    protected abstract function updateAuthenticatedUser(User $user, $userData);

    /**
     * Get authentication exception message.
     *
     * @return string
     */
    protected abstract function getExceptionMessage();
}