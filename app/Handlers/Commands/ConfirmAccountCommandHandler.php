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
        $user = $this->activateAccount($command);

        return $this->persistActivatedAccount($user);
    }

    /**
     * Activate user account.
     *
     * @param ConfirmAccountCommand $command
     *
     * @return mixed
     */
    private function activateAccount(ConfirmAccountCommand $command)
    {
        $user = $this->userRepository->findByCodeAndActiveState($command->code, false);

        $user->activation_code = '';

        $user->active = true;

        return $user;
    }

    /**
     * Persist activated account to the database.
     *
     * @param $user
     *
     * @return bool
     */
    private function persistActivatedAccount($user)
    {
        if ( ! $user->save()) return false;

        event(new UserWasActivatedEvent($user));

        $this->auth->login($user);

        return true;
    }

}
