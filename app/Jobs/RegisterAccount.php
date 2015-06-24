<?php

namespace Keep\Jobs;

use Keep\Events\UserHasRegistered;
use Illuminate\Contracts\Bus\SelfHandling;
use Keep\Repositories\User\UserRepositoryInterface;

class RegisterAccount extends Job implements SelfHandling
{
    protected $name, $email, $password;

    /**
     * Create a new job instance.
     *
     * @param   $name
     * @param   $email
     * @param   $password
     */
    public function __construct($name, $email, $password)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * Register new account.
     *
     * @param UserRepositoryInterface $users
     *
     * @return bool
     */
    public function handle(UserRepositoryInterface $users)
    {
        $user = $users->create($this->getCredentials());
        if (!$user) {
            return false;
        }
        event(new UserHasRegistered($user));

        return true;
    }

    /**
     * Get user credentials.
     *
     * @return array
     */
    private function getCredentials()
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
        ];
    }
}
