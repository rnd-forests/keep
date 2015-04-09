<?php namespace Keep\Handlers\Commands;

use App;
use Keep\Events\UserWasRegisteredEvent;
use Keep\Commands\RegisterAccountCommand;

class RegisterAccountCommandHandler {

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
        $users = App::make('Keep\Repositories\User\UserRepositoryInterface');

        $user = $users->create($this->getRequestData($command));

        if ( ! $user) return false;

        event(new UserWasRegisteredEvent($user));

        return true;
    }

}
