<?php namespace Keep\Handlers\Commands;

use Keep\Events\UserWasRegisteredEvent;
use Keep\Commands\RegisterAccountCommand;
use Keep\Repositories\User\UserRepositoryInterface;

class RegisterAccountCommandHandler {

    protected $userRepository;

    /**
     * Create the command handler.
     *
     * @param \Keep\Repositories\User\UserRepositoryInterface $userRepository
     */
	public function __construct(UserRepositoryInterface $userRepository)
	{
		$this->userRepository = $userRepository;
	}

    /**
     * Handle the command.
     *
     * @param  RegisterAccountCommand $command
     *
     * @return bool
     */
	public function handle(RegisterAccountCommand $command)
	{
		$data = array(
            'name' => $command->getName(),
            'email' => $command->getEmail(),
            'password' => $command->getPassword()
        );

        $user = $this->userRepository->create($data);

        if ($user)
        {
            event(new UserWasRegisteredEvent($user));

            return true;
        }

        return false;
	}

}
