<?php

namespace Keep\Core\OAuth\Contracts;

interface OpenAuthenticatable
{
    /**
     * Get the open authentication provider name.
     *
     * @return string
     */
    public function getAuthenticationProvider();

    /**
     * Authenticate user with the given authentication provider.
     *
     * @param $hasCode
     * @param $provider
     * @param $message
     * @param OAuthUserListener $listener
     *
     * @return mixed
     */
    public function authenticate($hasCode, $provider, $message, OAuthUserListener $listener);

    /**
     * Get the authentication exception message.
     *
     * @return string
     */
    public function getAuthenticationException();
}
