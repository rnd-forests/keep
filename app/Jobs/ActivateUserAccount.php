<?php

namespace Keep\Jobs;

use Illuminate\Contracts\Bus\SelfHandling;
use Keep\Repositories\Contracts\UserRepositoryInterface as UserRepository;

class ActivateUserAccount extends Job implements SelfHandling
{
    protected $code;

    public function __construct($code)
    {
        $this->code = $code;
    }

    /**
     * Activate user account.
     *
     * @param UserRepository $users
     *
     * @return bool
     */
    public function handle(UserRepository $users)
    {
        $user = $users->findByActivationCode($this->code);
        if ($this->canBeActivated($user)) {
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
    protected function canBeActivated($user)
    {
        return $user->update(['activation_code' => '', 'active' => true]);
    }
}
