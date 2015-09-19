<?php

namespace Keep\Entities\Presenters;

class UserPresenter extends Presenter
{
    /**
     * Get user gravatar picture.
     *
     * @param int $size
     * @return string
     */
    public function gravatar($size = 35)
    {
        return trans(
            'presenter.gravatar_link',
            ['email' => md5($this->email), 'size' => $size]
        );
    }

    /**
     * Link to user GitHub profile.
     *
     * @param $user
     * @return string
     */
    public function githubProfile($user)
    {
        return trans(
            'presenter.github_profile',
            ['username' => $user->profile->github_username]
        );
    }

    /**
     * Link to user Google Plus profile.
     *
     * @param $user
     * @return string
     */
    public function googlePlusProfile($user)
    {
        return trans(
            'presenter.google_profile',
            ['username' => $user->profile->google_username]
        );
    }

    /**
     * Link to user Facebook profile.
     *
     * @param $user
     * @return string
     */
    public function facebookProfile($user)
    {
        return trans(
            'presenter.facebook_profile',
            ['username' => $user->profile->facebook_username]
        );
    }
}
