<?php namespace Keep\Handlers\Commands;

use Illuminate\Hashing\BcryptHasher;
use Keep\Commands\ModifyPasswordCommand;
use Keep\Repositories\User\UserRepositoryInterface;

class ModifyPasswordCommandHandler {

    protected $bcrypt, $userRepository;

    /**
     * Create the command handler.
     *
     * @param BcryptHasher            $bcrypt
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(BcryptHasher $bcrypt, UserRepositoryInterface $userRepository)
    {
        $this->bcrypt = $bcrypt;
        $this->userRepository = $userRepository;
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
     * Check the old password.
     *
     * @param ModifyPasswordCommand $command
     * @param                       $user
     *
     * @return bool
     */
    private function checkOldPassword(ModifyPasswordCommand $command, $user)
    {
        return $this->bcrypt->check($command->getOldPassword(), $user->password);
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
        $user = $this->userRepository->findById($this->userRepository->getAuthUser()->id);

        if ( ! $this->checkOldPassword($command, $user)) return false;

        $user->password = $command->getNewPassword();

        return $user->save();
    }

}
