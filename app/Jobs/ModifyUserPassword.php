<?php

namespace Keep\Jobs;

use Illuminate\Contracts\Bus\SelfHandling;

class ModifyUserPassword extends Job implements SelfHandling
{
    protected $user, $oldPassword, $newPassword;

    public function __construct($user, $old_password, $new_password)
    {
        $this->user = $user;
        $this->oldPassword = $old_password;
        $this->newPassword = $new_password;
    }

    /**
     * Change account password.
     *
     * @return bool
     */
    public function handle()
    {
        if (!$this->isValidOldPassword()) {
            return false;
        }

        return $this->setNewPassword();
    }

    /**
     * Check if the old password is correct.
     *
     * @return bool
     */
    protected function isValidOldPassword()
    {
        return app('hash')->check($this->oldPassword, $this->user->password);
    }

    /**
     * Set the new password for the user.
     *
     * @return bool
     */
    protected function setNewPassword()
    {
        $this->user->password = $this->newPassword;

        return $this->user->save();
    }
}
