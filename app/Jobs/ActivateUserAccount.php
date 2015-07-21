<?php

namespace Keep\Jobs;

use Illuminate\Contracts\Bus\SelfHandling;
use Keep\Repositories\User\UserRepositoryInterface as UserRepo;

class ActivateUserAccount extends Job implements SelfHandling
{
    protected $code;

    /**
     * Create a new job instance.
     *
     * @param $code
     */
    public function __construct($code)
    {
        $this->code = $code;
    }

    /**
     * Activate user account.
     *
     * @param UserRepo $users
     * @return bool
     */
    public function handle(UserRepo $users)
    {
        $user = $users->findByActivationCode($this->code);
        if ($this->isActivatable($user)) {
            auth()->login($user);
            return true;
        }

        return false;
    }

    /**
     * Check if user account can be activated or not.
     *
     * @param $user
     */
    protected function isActivatable($user)
    {
        return $user->update(['activation_code' => '', 'active' => true]);
    }
}
