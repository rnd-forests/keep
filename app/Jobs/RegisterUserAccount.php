<?php

namespace Keep\Jobs;

use Keep\Events\UserHasRegistered;
use Illuminate\Contracts\Bus\SelfHandling;
use Keep\Repositories\User\UserRepositoryInterface as UserRepo;

class RegisterUserAccount extends Job implements SelfHandling
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
     * @param UserRepo $users
     * @return bool
     */
    public function handle(UserRepo $users)
    {
        $credentials = [
            'name'     => $this->name,
            'email'    => $this->email,
            'password' => $this->password,
        ];

        $user = $users->create($credentials);
        if (!$user) {
            return false;
        }
        event(new UserHasRegistered($user));

        return true;
    }
}
