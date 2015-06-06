<?php
namespace Keep\Handlers\Commands;

use App;
use Keep\Commands\InitializeSessionCommand;

class InitializeSessionCommandHandler
{
    /**
     * Handle the command.
     *
     * @param InitializeSessionCommand $command
     *
     * @return bool
     */
    public function handle(InitializeSessionCommand $command)
    {
        $auth = App::make('Illuminate\Contracts\Auth\Guard');

        return $auth->attempt($this->getRequestData($command), $command->remember);
    }

    /**
     * Get the request data.
     *
     * @param InitializeSessionCommand $command
     *
     * @return array
     */
    private function getRequestData(InitializeSessionCommand $command)
    {
        return [
            'email'    => $command->email,
            'password' => $command->password,
            'active'   => $command->active,
        ];
    }
}
