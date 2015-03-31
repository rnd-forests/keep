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
        return $this->auth->attempt($this->getRequestData($command), $command->getRemember());
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
        $credentials = array(
            'email'    => $command->getEmail(),
            'password' => $command->getPassword(),
            'active'   => $command->getActive(),
        );

        return $credentials;
    }

}
