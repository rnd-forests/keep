<?php

namespace Keep\Presenters;

use Laracasts\Presenter\Presenter;

class UserPresenter extends Presenter
{
    /**
     * Get user gravatar picture.
     *
     * @param int $size
     *
     * @return string
     */
    public function gravatar($size = 35)
    {
        $email = md5($this->email);

        return "//www.gravatar.com/avatar/$email?s=$size";
    }

    /**
     * Link to user GitHub profile.
     *
     * @param $user
     *
     * @return string
     */
    public function githubProfile($user)
    {
        return 'http://www.github.com/'.$user->profile->github_username;
    }

    /**
     * Link to user Google Plus profile.
     *
     * @param $user
     *
     * @return string
     */
    public function googlePlusProfile($user)
    {
        return 'https://plus.google.com/'.$user->profile->google_username;
    }

    /**
     * Link to user Facebook profile.
     *
     * @param $user
     *
     * @return string
     */
    public function facebookProfile($user)
    {
        return 'https://www.facebook.com/'.$user->profile->facebook_username;
    }
}
