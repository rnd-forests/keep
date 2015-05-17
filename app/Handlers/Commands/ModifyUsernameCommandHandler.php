<?php namespace Keep\Handlers\Commands;

use Keep\Commands\ModifyUsernameCommand;
use Keep\Repositories\User\UserRepositoryInterface;

class ModifyUsernameCommandHandler {

    protected $userRepo;

    /**
     * Create the command handler.
     *
     * @param UserRepositoryInterface $userRepo
     */
	public function __construct(UserRepositoryInterface $userRepo)
	{
		$this->userRepo = $userRepo;
	}

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
        $user = $this->userRepo->getAuthUser();

        if (! $this->checkOldUsername($command, $user)) return false;

        $user->name = $command->newUsername;

        return $user->save();
    }

    /**
     * Check old username.
     *
     * @param ModifyUsernameCommand $command
     * @param                       $user
     *
     * @return bool
     */
    public function checkOldUsername(ModifyUsernameCommand $command, $user)
    {
        return strcasecmp($command->oldUsername, $user->name) == 0;
    }

}
