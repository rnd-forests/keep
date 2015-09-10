<?php

namespace Keep\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Keep\Exceptions\InvalidUserException;
use Keep\Repositories\User\UserRepositoryInterface as UserRepository;

class RedirectIfNotCorrectUser
{
    protected $users, $auth;

    public function __construct(UserRepository $users, Guard $auth)
    {
        $this->users = $users;
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     * This middleware is responsible to check if the current authenticated
     * user is the same as the user in the currently requesting route.
     *
     * @param $request
     * @param callable|Closure $next
     * @return \Illuminate\Http\RedirectResponse
     * @throws InvalidUserException
     */
    public function handle($request, Closure $next)
    {
        if ($request->route('users')) {
            $user = $this->users->findBySlug($request->route('users'));
            if (($user->id != $this->auth->user()->id) && !$this->auth->user()->isAdmin()) {
                throw new InvalidUserException(trans('exception.invalid_user_exception'));
            }
        }

        return $next($request);
    }
}
