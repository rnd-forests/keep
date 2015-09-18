<?php

namespace Keep\Jobs;

use Keep\Events\UserHasRegistered;
use Illuminate\Contracts\Bus\SelfHandling;
use Keep\Repositories\Contracts\UserRepositoryInterface as UserRepository;

class RegisterUserAccount extends Job implements SelfHandling
{
    protected $name, $email, $password;

    public function __construct($name, $email, $password)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * Register new account.
     *
     * @param UserRepository $users
     *
     * @return bool
     */
    public function handle(UserRepository $users)
    {
        $user = $users->create($this->getUserData());
        if (!$user) {
            return false;
        }
        event(new UserHasRegistered($user));

        return true;
    }

    protected function getUserData()
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
        ];
    }
}
