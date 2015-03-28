<?php namespace Keep\Handlers\Commands;

use Illuminate\Contracts\Auth\Guard;
use Keep\Events\UserWasActivatedEvent;
use Keep\Commands\ConfirmAccountCommand;
use Keep\Repositories\User\UserRepositoryInterface;

class ConfirmAccountCommandHandler {

    protected $auth, $userRepository;

    /**
     * Create the command handler.
     *
     * @param Guard                   $auth
     * @param UserRepositoryInterface $userRepository
     */
	public function __construct(Guard $auth, UserRepositoryInterface $userRepository)
	{
        $this->auth = $auth;
		$this->userRepository = $userRepository;
	}

    /**
     * Handle the command.
     *
     * @param ConfirmAccountCommand $command
     *
     * @return bool
     */
	public function handle(ConfirmAccountCommand $command)
	{
        $user = $this->userRepository->findByCodeAndActiveState($command->getCode(), false);

        $user->activation_code = '';

        $user->active = true;

        if ($user->save())
        {
            event(new UserWasActivatedEvent($user));

            $this->auth->login($user);

            return true;
        }

        return false;
	}

}
