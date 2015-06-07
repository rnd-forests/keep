<?php
namespace Keep\Handlers\Commands;

use App;
use Keep\Commands\InitializeUserSession;

class InitializeUserSessionHandler
{
    /**
     * Handle the command.
     *
     * @param InitializeUserSession $command
     *
     * @return bool
     */
    public function handle(InitializeUserSession $command)
    {
        $auth = App::make('Illuminate\Contracts\Auth\Guard');

        return $auth->attempt($this->getRequestData($command), $command->remember);
    }

    /**
     * Get the request data.
     *
     * @param InitializeUserSession $command
     *
     * @return array
     */
    private function getRequestData(InitializeUserSession $command)
    {
        return [
            'email'    => $command->email,
            'password' => $command->password,
            'active'   => $command->active,
        ];
    }
}
