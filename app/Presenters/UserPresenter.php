<?php namespace Keep\Presenters;

use Laracasts\Presenter\Presenter;

class UserPresenter extends Presenter {

    use KeepPresentableTrait;

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
     * Print user model attributes.
     *
     * @param $attribute
     *
     * @return string
     */
    public function attribute($attribute)
    {
        if (empty($attribute)) return '-';

        return $attribute;
    }

    /**
     * Link to user twitter profile.
     *
     * @param $user
     *
     * @return string
     */
    public function twitterProfile($user)
    {
        return 'http://www.twitter.com/' . $user->profile->twitter_username;
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
        return 'http://www.github.com/' . $user->profile->github_username;
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
        return 'https://plus.google.com/' . $user->profile->google_plus_username;
    }

}