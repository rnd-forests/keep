<?php

namespace Keep\Http\Middleware;

use Closure;
use Keep\Exceptions\InvalidUserException;
use Keep\Repositories\User\UserRepositoryInterface;

class RedirectIfNotCorrectUser
{
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
        $userRepo = app()->make(UserRepositoryInterface::class);
        if ($request->route('users')) {
            $user = $userRepo->findBySlug($request->route('users'));
            if (($user->id != auth()->user()->id) && !auth()->user()->isAdmin()) {
                throw new InvalidUserException('You cannot access this page.');
            }
        }

        return $next($request);
    }
}
