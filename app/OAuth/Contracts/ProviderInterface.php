<?php
namespace Keep\OAuth\Contracts;

interface ProviderInterface
{
    public function authenticate($hasCode, OAuthUserListener $listener);
}
