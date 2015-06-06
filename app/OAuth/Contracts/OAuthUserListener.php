<?php
namespace Keep\OAuth\Contracts;

interface OAuthUserListener
{
    public function userHasLoggedIn($user);
}