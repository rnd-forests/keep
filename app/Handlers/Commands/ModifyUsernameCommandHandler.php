<?php
namespace Keep\Handlers\Commands;

use Keep\Commands\ModifyUsernameCommand;

class ModifyUsernameCommandHandler
{
    /**
     * Handle the command.
     *
     * @param  ModifyUsernameCommand $command
     *
     * @return bool
     */
    public function handle(ModifyUsernameCommand $command)
    {
        return $this->modifyUsername($command);
    }

    /**
     * Modify username.
     *
     * @param ModifyUsernameCommand $command
     *
     * @return bool
     */
    public function modifyUsername(ModifyUsernameCommand $command)
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
     * @param ModifyUsernameCommand $command
     *
     * @return bool
     */
    public function checkOldUsername(ModifyUsernameCommand $command)
    {
        return strcasecmp($command->oldUsername, $command->user->name) == 0;
    }
}
