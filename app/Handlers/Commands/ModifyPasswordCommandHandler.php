<?php namespace Keep\Handlers\Commands;

use Illuminate\Hashing\BcryptHasher;
use Keep\Commands\ModifyPasswordCommand;

class ModifyPasswordCommandHandler {

    protected $bcrypt, $userRepo;

    /**
     * Create the command handler.
     *
     * @param BcryptHasher            $bcrypt
     */
    public function __construct(BcryptHasher $bcrypt)
    {
        $this->bcrypt = $bcrypt;
    }

    /**
     * Handle the command.
     *
     * @param ModifyPasswordCommand $command
     *
     * @return bool
     */
    public function handle(ModifyPasswordCommand $command)
    {
        return $this->modifyPassword($command);
    }

    /**
     * Modify the user account password.
     *
     * @param ModifyPasswordCommand $command
     *
     * @return bool
     */
    private function modifyPassword(ModifyPasswordCommand $command)
    {
        if ( ! $this->checkOldPassword($command, $command->user)) return false;

        $command->user->password = $command->newPassword;

        return $command->user->save();
    }

    /**
     * Check the old password.
     *
     * @param ModifyPasswordCommand $command
     * @param                       $user
     *
     * @return bool
     */
    private function checkOldPassword(ModifyPasswordCommand $command, $user)
    {
        return $this->bcrypt->check($command->oldPassword, $user->password);
    }

}
