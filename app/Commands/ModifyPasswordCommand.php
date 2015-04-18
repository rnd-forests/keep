<?php namespace Keep\Commands;

class ModifyPasswordCommand extends Command {

    public $oldPassword;
    public $newPassword;

    public function __construct($old_password, $new_password)
    {
        $this->oldPassword = $old_password;
        $this->newPassword = $new_password;
    }

}
