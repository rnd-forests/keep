<?php

namespace Keep\OAuth;

use Keep\OAuth\Contracts\OpenAuthenticatable;

class GithubAuthentication extends OpenAuthentication implements OpenAuthenticatable
{
    /**
     * Get the open authentication provider name.
     *
     * @return string
     */
    public function getAuthenticationProvider()
    {
        return 'github';
    }

    /**
     * Get the authentication exception message.
     *
     * @return string
     */
    public function getAuthenticationException()
    {
        return trans('authentication.github_error');
    }
}
