<?php namespace Keep\Commands;

class ModifyUsernameCommand extends Command {

    public $user;
    public $oldUsername;
    public $newUsername;

    public function __construct($user, $old_username, $new_username)
    {
        $this->user = $user;
        $this->oldUsername = $old_username;
        $this->newUsername = $new_username;
    }

}
