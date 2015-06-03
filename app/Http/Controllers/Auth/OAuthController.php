<?php namespace Keep\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Keep\OAuth\GithubAuthentication;
use Keep\Http\Controllers\Controller;
use Keep\OAuth\Contracts\OAuthUserListener;

class OAuthController extends Controller implements OAuthUserListener {

    /**
     * Authenticate user using GitHub provider.
     *
     * @param GithubAuthentication $githubAuthentication
     * @param Request              $request
     *
     * @return mixed
     */
    public function loginWithGithub(GithubAuthentication $githubAuthentication, Request $request)
    {
        return $githubAuthentication->execute($request->has('code'), $this);
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
