<?php namespace Keep\OAuth;

use Keep\Entities\User;
use Illuminate\Contracts\Auth\Guard;
use Keep\Exceptions\InvalidUserException;
use Keep\OAuth\Contracts\OAuthUserListener;
use Keep\Repositories\User\UserRepositoryInterface;
use Laravel\Socialite\Contracts\Factory as Socialite;
use Laravel\Socialite\Contracts\User as SocialiteUser;

abstract class AuthenticationProvider {

    protected $userRepo, $socialite, $auth;

    /**
     * Constructor.
     *
     * @param UserRepositoryInterface $userRepo
     * @param Socialite               $socialite
     * @param Guard                   $auth
     */
    public function __construct(UserRepositoryInterface $userRepo, Socialite $socialite, Guard $auth)
    {
        $this->userRepo = $userRepo;
        $this->socialite = $socialite;
        $this->auth = $auth;
    }

    /**
     * Authenticate user.
     *
     * @param                   $hasCode
     * @param OAuthUserListener $listener
     * @param                   $provider
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws InvalidUserException
     */
    public function authenticate($hasCode, OAuthUserListener $listener, $provider)
    {
        if (!$hasCode) return $this->getAuthorizationUrl($provider);

        $providerData = $this->handleProviderCallback($provider);

        $user = $this->userRepo->findByUsernameOrCreate($this->getUserProviderData($providerData), $provider);

        if (!$user) throw new InvalidUserException($this->getExceptionMessage());

        $this->updateAuthenticatedUser($user, $providerData);

        $this->auth->login($user, true);

        return $listener->userHasLoggedIn($user);
    }

    /**
     * Get the provider authorization URL.
     *
     * @param $provider
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function getAuthorizationUrl($provider)
    {
        return $this->socialite->driver($provider)->redirect();
    }

    /**
     * Handler provider callback.
     *
     * @param $provider
     *
     * @return \Laravel\Socialite\Contracts\User
     */
    public function handleProviderCallback($provider)
    {
        return $this->socialite->driver($provider)->user();
    }

    /**
     * Get data from provider returned information.
     *
     * @param $postBackData
     *
     * @return array
     */
    public function getUserProviderData(SocialiteUser $postBackData)
    {
        return [
            'auth_provider_id' => $postBackData->getId(),
            'name'             => $postBackData->getName(),
            'email'            => $postBackData->getEmail(),
        ];
    }

    /**
     * Update authenticated user profile.
     *
     * @param User $user
     * @param      $userData
     *
     * @return mixed
     */
    abstract function updateAuthenticatedUser(User $user, $userData);

    /**
     * Get authentication exception message.
     *
     * @return string
     */
    abstract function getExceptionMessage();

}