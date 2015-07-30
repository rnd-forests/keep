<?php

namespace Keep\Http\Controllers\Auth;

use Keep\OAuth\GithubAuthentication;
use Keep\OAuth\GoogleAuthentication;
use Keep\Http\Controllers\Controller;
use Keep\OAuth\FacebookAuthentication;
use Keep\OAuth\Contracts\OAuthUserListener;
use Keep\OAuth\Contracts\OpenAuthenticatable;

class OAuthController extends Controller implements OAuthUserListener
{
    /**
     * Create new oauth controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Authenticate user using GitHub provider.
     *
     * @param GithubAuthentication $github
     * @return mixed
     */
    public function authenticateWithGithub(GithubAuthentication $github)
    {
        return $this->authenticateWith($github);
    }

    /**
     * Authenticate user using Facebook provider.
     *
     * @param FacebookAuthentication $facebook
     * @return mixed
     */
    public function authenticateWithFacebook(FacebookAuthentication $facebook)
    {
        return $this->authenticateWith($facebook);
    }

    /**
     * Authenticate user using Google provider.
     *
     * @param GoogleAuthentication $google
     * @return mixed
     */
    public function authenticateWithGoogle(GoogleAuthentication $google)
    {
        return $this->authenticateWith($google);
    }

    /**
     * Log the user in the application using the given authentication provider.
     *
     * @param OpenAuthenticatable $provider
     * @return mixed
     */
    protected function authenticateWith(OpenAuthenticatable $provider)
    {
        return $provider->authenticate(
            app('request')->has('code'),
            $provider->getAuthenticationProvider(),
            $provider->getAuthenticationException(),
            $this
        );
    }

    /**
     * Response to open authentication on success event.
     *
     * @param $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function userHasLoggedIn($user)
    {
        flash()->success(trans('authentication.social_auth_success'));

        return redirect()->route('member::profile', $user);
    }
}
