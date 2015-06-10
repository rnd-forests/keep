<?php
namespace Keep\Jobs;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Bus\SelfHandling;

class AuthenticateAccount extends Job implements SelfHandling
{
    protected $email, $password, $active, $remember;

    /**
     * Create a new job instance.
     *
     * @param $email
     * @param $password
     * @param $active
     * @param $remember
     */
    public function __construct($email, $password, $active, $remember)
    {
        $this->email = $email;
        $this->password = $password;
        $this->active = $active;
        $this->remember = $remember;
    }

    /**
     * Authenticate user into application.
     *
     * @param Guard $auth
     *
     * @return bool
     */
    public function handle(Guard $auth)
    {
        return $auth->attempt($this->getCredentials(), $this->remember);
    }

    /**
     * Get user credentials.
     *
     * @return array
     */
    private function getCredentials()
    {
        return [
            'email'    => $this->email,
            'password' => $this->password,
            'active'   => $this->active,
        ];
    }
}
