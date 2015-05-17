<?php namespace Keep\Commands;

class ModifyUsernameCommand extends Command {

    public $oldUsername;
    public $newUsername;

    public function __construct($old_username, $new_username)
    {
        $this->oldUsername = $old_username;
        $this->newUsername = $new_username;
    }

}
