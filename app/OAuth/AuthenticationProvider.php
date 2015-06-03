<?php namespace Keep\OAuth;

use Illuminate\Contracts\Auth\Guard;
use Keep\Repositories\User\UserRepositoryInterface;
use Laravel\Socialite\Contracts\Factory as Socialite;

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
     * @return array
     */
    abstract public function getProviderData();

}