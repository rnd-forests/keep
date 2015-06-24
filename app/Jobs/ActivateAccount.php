<?php
namespace Keep\Jobs;

use Illuminate\Contracts\Bus\SelfHandling;
use Keep\Repositories\User\UserRepositoryInterface;

class ActivateAccount extends Job implements SelfHandling
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
     * @param UserRepositoryInterface $users
     *
     * @return bool
     */
    public function handle(UserRepositoryInterface $users)
    {
        $user = $users->findByActivationCode($this->code);
        $user->update(['activation_code' => '', 'active' => true]);
        if (! $user->save()) {
            return false;
        }
        auth()->login($user);

        return true;
    }
}
