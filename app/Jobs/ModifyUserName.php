<?php

namespace Keep\Jobs;

use Illuminate\Contracts\Bus\SelfHandling;

class ModifyUserName extends Job implements SelfHandling
{
    protected $user, $oldUsername, $newUsername;

    /**
     * Create a new job instance.
     *
     * @param $user
     * @param $old_username
     * @param $new_username
     */
    public function __construct($user, $old_username, $new_username)
    {
        $this->user = $user;
        $this->oldUsername = $old_username;
        $this->newUsername = $new_username;
    }

    /**
     * Change account name.
     *
     * @return bool
     */
    public function handle()
    {
        if ($this->areTheSameNames()) {
            return false;
        }

        return $this->setNewUsername();
    }

    /**
     * Check if the new username and old username are the same (case-sensitive).
     *
     * @return bool
     */
    protected function areTheSameNames()
    {
        return strcasecmp($this->oldUsername, $this->newUsername) == 0;
    }

    /**
     * Set the new username for the user.
     *
     * @return bool
     */
    protected function setNewUsername()
    {
        $this->user->name = $this->newUsername;

        return $this->user->save();
    }
}
