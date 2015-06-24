<?php

namespace Keep\Jobs;

use Illuminate\Contracts\Bus\SelfHandling;

class ModifyAccountName extends Job implements SelfHandling
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
        if (!strcasecmp($this->oldUsername, $this->user->name) == 0) {
            return false;
        }
        $this->user->name = $this->newUsername;

        return $this->user->save();
    }
}
