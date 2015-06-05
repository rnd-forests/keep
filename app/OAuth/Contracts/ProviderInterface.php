<?php namespace Keep\OAuth\Contracts;

interface ProviderInterface {

    /**
     * Authenticate the user.
     *
     * @param $hasCode
     * @param $listener
     *
     * @return mixed
     */
    public function authenticate($hasCode, OAuthUserListener $listener);

}