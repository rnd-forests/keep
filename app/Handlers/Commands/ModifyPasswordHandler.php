<?php
namespace Keep\Handlers\Commands;

use Illuminate\Hashing\BcryptHasher;
use Keep\Commands\ModifyPassword;

class ModifyPasswordHandler
{
    protected $bcrypt;

    /**
     * Create the command handler.
     *
     * @param BcryptHasher $bcrypt
     */
    public function __construct(BcryptHasher $bcrypt)
    {
        $this->bcrypt = $bcrypt;
    }

    /**
     * Handle the command.
     *
     * @param ModifyPassword $command
     *
     * @return bool
     */
    public function handle(ModifyPassword $command)
    {
        return $this->modifyPassword($command);
    }

    /**
     * Modify the user account password.
     *
     * @param ModifyPassword $command
     *
     * @return bool
     */
    private function modifyPassword(ModifyPassword $command)
    {
        if ( ! $this->checkOldPassword($command)) {
            return false;
        }
        $command->user->password = $command->newPassword;

        return $command->user->save();
    }

    /**
     * Check the old password.
     *
     * @param ModifyPassword $command
     *
     * @return bool
     */
    private function checkOldPassword(ModifyPassword $command)
    {
        return $this->bcrypt->check($command->oldPassword, $command->user->password);
    }
}
