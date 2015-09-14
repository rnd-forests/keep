<?php

namespace Keep\Jobs;

use Illuminate\Contracts\Bus\SelfHandling;

class UpdateUserName extends Job implements SelfHandling
{
    protected $user, $oldUsername, $newUsername;

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
        if (!$this->isCorrectOldName() || $this->areTheSameNames()) {
            return false;
        }

        return $this->setNewName();
    }

    /**
     * Check if the new name and old name are the same (case-sensitive).
     *
     * @return bool
     */
    protected function areTheSameNames()
    {
        return strcasecmp($this->oldUsername, $this->newUsername) === 0;
    }

    /**
     * Check if the old name is correct.
     *
     * @return bool
     */
    protected function isCorrectOldName()
    {
        return strcasecmp($this->oldUsername, auth()->user()->name) === 0;
    }

    /**
     * Set the new name for the user.
     *
     * @return bool
     */
    protected function setNewName()
    {
        $this->user->name = $this->newUsername;

        return $this->user->save();
    }
}
