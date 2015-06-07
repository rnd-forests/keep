<?php
namespace Keep\Handlers\Commands;

use Keep\Commands\ModifyUsername;

class ModifyUsernameHandler
{
    /**
     * Handle the command.
     *
     * @param  ModifyUsername $command
     *
     * @return bool
     */
    public function handle(ModifyUsername $command)
    {
        return $this->modifyUsername($command);
    }

    /**
     * Modify username.
     *
     * @param ModifyUsername $command
     *
     * @return bool
     */
    public function modifyUsername(ModifyUsername $command)
    {
        if ( ! $this->checkOldUsername($command)) {
            return false;
        }
        $command->user->name = $command->newUsername;

        return $command->user->save();
    }

    /**
     * Check old username.
     *
     * @param ModifyUsername $command
     *
     * @return bool
     */
    public function checkOldUsername(ModifyUsername $command)
    {
        return strcasecmp($command->oldUsername, $command->user->name) == 0;
    }
}
