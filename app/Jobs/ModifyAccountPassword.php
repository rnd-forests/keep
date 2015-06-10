<?php
namespace Keep\Jobs;

use Illuminate\Hashing\BcryptHasher;
use Illuminate\Contracts\Bus\SelfHandling;

class ModifyAccountPassword extends Job implements SelfHandling
{
    protected $user, $oldPassword, $newPassword;

    /**
     * Create a new job instance.
     *
     * @param $user
     * @param $old_password
     * @param $new_password
     */
    public function __construct($user, $old_password, $new_password)
    {
        $this->user = $user;
        $this->oldPassword = $old_password;
        $this->newPassword = $new_password;
    }

    /**
     * Change account password.
     *
     * @param BcryptHasher $bcrypt
     *
     * @return bool
     */
    public function handle(BcryptHasher $bcrypt)
    {
        if ( ! $bcrypt->check($this->oldPassword, $this->user->password)) {
            return false;
        }
        $this->user->password = $this->newPassword;

        return $this->user->save();
    }
}