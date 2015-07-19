<?php

namespace Keep\Http\Middleware;

use Closure;
use Keep\Exceptions\InvalidRolesException;

class VerifyUserRoles
{
    /**
     * Handle an incoming request.
     *
     * @param $request
     * @param Closure $next
     * @param $roles
     * @return mixed
     * @throws InvalidRolesException
     */
    public function handle($request, Closure $next, $roles)
    {
        if (!auth()->user()->hasRole($roles, true)) {
            throw new InvalidRolesException('Not enough roles to perform this action.');
        }

        return $next($request);
    }
}
