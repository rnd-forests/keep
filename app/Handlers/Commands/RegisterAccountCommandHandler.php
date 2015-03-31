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
        return $this->registerAccount($command);
	}

    /**
     * Get request data.
     *
     * @param RegisterAccountCommand $command
     *
     * @return array
     */
    private function getRequestData(RegisterAccountCommand $command)
    {
        $credentials = array(
            'name'     => $command->getName(),
            'email'    => $command->getEmail(),
            'password' => $command->getPassword()
        );

        return $credentials;
    }

    /**
     * Register new account.
     *
     * @param RegisterAccountCommand $command
     *
     * @return bool
     */
    private function registerAccount(RegisterAccountCommand $command)
    {
        $user = $this->userRepository->create($this->getRequestData($command));

        if ( ! $user)
        {
            return false;
        }

        event(new UserWasRegisteredEvent($user));

        return true;
    }

}
