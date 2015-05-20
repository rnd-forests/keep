<?php namespace Keep\Commands;

class ModifyPasswordCommand extends Command {

    public $user;
    public $oldPassword;
    public $newPassword;

    public function __construct($user, $old_password, $new_password)
    {
        $this->user = $user;
        $this->oldPassword = $old_password;
        $this->newPassword = $new_password;
    }

}
