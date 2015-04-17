<?php namespace Keep\Commands;

class ModifyPasswordCommand extends Command {

    protected $oldPassword, $newPassword;

    public function __construct($old_password, $new_password)
    {
        $this->oldPassword = $old_password;
        $this->newPassword = $new_password;
    }

    public function getOldPassword()
    {
        return $this->oldPassword;
    }

    public function getNewPassword()
    {
        return $this->newPassword;
    }

}
