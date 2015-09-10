<?php

namespace Keep\Jobs;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Bus\SelfHandling;

class AuthenticateUser extends Job implements SelfHandling
{
    protected $email, $password, $active, $remember;

    public function __construct($email, $password, $active, $remember)
    {
        $this->email = $email;
        $this->active = $active;
        $this->password = $password;
        $this->remember = $remember;
    }

    /**
     * Authenticate user into application.
     *
     * @param Guard $auth
     * @return bool
     */
    public function handle(Guard $auth)
    {
        $credentials = [
            'email'    => $this->email,
            'password' => $this->password,
            'active'   => $this->active,
        ];

        return $auth->attempt($credentials, $this->remember);
    }
}
