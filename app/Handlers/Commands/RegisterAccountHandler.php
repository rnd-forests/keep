<?php
namespace Keep\Handlers\Commands;

use App;
use Keep\Events\UserWasRegisteredEvent;
use Keep\Commands\RegisterAccount;
use Keep\Repositories\User\UserRepositoryInterface;

class RegisterAccountHandler
{
    /**
     * Handle the command.
     *
     * @param  RegisterAccount $command
     *
     * @return bool
     */
    public function handle(RegisterAccount $command)
    {
        return $this->register($command);
    }

    /**
     * Register new account.
     *
     * @param RegisterAccount $command
     *
     * @return bool
     */
    private function register(RegisterAccount $command)
    {
        $users = App::make(UserRepositoryInterface::class);
        $user = $users->create($this->getRequestData($command));
        if ( ! $user) {
            return false;
        }
        event(new UserWasRegisteredEvent($user));

        return true;
    }

    /**
     * Get request data.
     *
     * @param RegisterAccount $command
     *
     * @return array
     */
    private function getRequestData(RegisterAccount $command)
    {
        return [
            'name'     => $command->name,
            'email'    => $command->email,
            'password' => $command->password
        ];
    }
}
