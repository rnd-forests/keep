<?php namespace Keep\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Keep\OAuth\GithubAuthentication;
use Keep\Http\Controllers\Controller;
use Keep\OAuth\FacebookAuthentication;
use Keep\OAuth\Contracts\OAuthUserListener;
use Keep\OAuth\GoogleAuthentication;

class OAuthController extends Controller implements OAuthUserListener {

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
     * @param Request              $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \Keep\Exceptions\InvalidUserException
     */
    public function loginWithGithub(GithubAuthentication $github, Request $request)
    {
        return $github->authenticate($request->has('code'), $this);
    }

    /**
     * Authenticate user using Facebook provider.
     *
     * @param FacebookAuthentication $facebook
     * @param Request                $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \Keep\Exceptions\InvalidUserException
     */
    public function loginWithFacebook(FacebookAuthentication $facebook, Request $request)
    {
        return $facebook->authenticate($request->has('code'), $this);
    }

    /**
     * Authenticate user using Google provider.
     *
     * @param GoogleAuthentication $google
     * @param Request              $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \Keep\Exceptions\InvalidUserException
     */
    public function loginWithGoogle(GoogleAuthentication $google, Request $request)
    {
        return $google->authenticate($request->has('code'), $this);
    }

    /**
     * User has logged in event.
     *
     * @param $user
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function userHasLoggedIn($user)
    {
        flash()->success('Your social authentication process was successful.');

        return redirect()->route('users.show', $user);
    }

}
