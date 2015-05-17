<?php namespace Keep\Handlers\Commands;

use Illuminate\Hashing\BcryptHasher;
use Keep\Commands\ModifyPasswordCommand;
use Keep\Repositories\User\UserRepositoryInterface;

class ModifyPasswordCommandHandler {

    protected $bcrypt, $userRepo;

    /**
     * Create the command handler.
     *
     * @param BcryptHasher            $bcrypt
     * @param UserRepositoryInterface $userRepo
     */
    public function __construct(BcryptHasher $bcrypt, UserRepositoryInterface $userRepo)
    {
        $this->bcrypt = $bcrypt;
        $this->userRepo = $userRepo;
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
        $user = $this->userRepo->getAuthUser();

        if ( ! $this->checkOldPassword($command, $user)) return false;

        $user->password = $command->newPassword;

        return $user->save();
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
