<?php namespace Keep\Handlers\Commands;

use Keep\Entities\User;
use Illuminate\Contracts\Auth\Guard;
use Keep\Events\UserWasActivatedEvent;
use Keep\Commands\ConfirmAccountCommand;
use Keep\Repositories\User\UserRepositoryInterface;

class ConfirmAccountCommandHandler {

    protected $auth, $userRepo;

    /**
     * Create the command handler.
     *
     * @param Guard                   $auth
     * @param UserRepositoryInterface $userRepo
     */
    public function __construct(Guard $auth, UserRepositoryInterface $userRepo)
    {
        $this->auth = $auth;
        $this->userRepo = $userRepo;
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
        $user = $this->activate($command);

        return $this->persist($user);
    }

    /**
     * Activate user account.
     *
     * @param ConfirmAccountCommand $command
     *
     * @return mixed
     */
    private function activate(ConfirmAccountCommand $command)
    {
        $user = $this->userRepo->findByCodeAndActiveState($command->code, false);

        $user->activation_code = '';

        $user->active = true;

        return $user;
    }

    /**
     * Persist activated account to the database.
     *
     * @param User $user
     *
     * @return bool
     */
    private function persist(User $user)
    {
        if ( ! $user->save()) return false;

        event(new UserWasActivatedEvent($user));

        $this->auth->login($user);

        return true;
    }

}
