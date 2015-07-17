<?php

namespace Keep\OAuth\Contracts;

interface OAuthUserListener
{
    /**
     * Response to open authentication on success event.
     *
     * @param $user
     * @return mixed
     */
    public function userHasLoggedIn($user);
}
