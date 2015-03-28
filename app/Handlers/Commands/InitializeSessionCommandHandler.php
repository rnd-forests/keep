<?php namespace Keep\Handlers\Commands;

use Illuminate\Contracts\Auth\Guard;
use Keep\Commands\InitializeSessionCommand;

class InitializeSessionCommandHandler {

    protected $auth;

    /**
     * Create the command handler.
     *
     * @param Guard $auth
     */
	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
	}

    /**
     * Handle the command.
     *
     * @param InitializeSessionCommand $command
     *
     * @return bool
     */
	public function handle(InitializeSessionCommand $command)
	{
		$credentials = array(
            'email' => $command->getEmail(),
            'password' => $command->getPassword(),
            'active' => $command->getActive(),
        );

        if ($this->auth->attempt($credentials, $command->getRemember()))
        {
            return true;
        }

        return false;
	}

}
