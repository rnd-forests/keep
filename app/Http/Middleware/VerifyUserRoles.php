<?php

namespace Keep\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Keep\Exceptions\InvalidRolesException;

class VerifyUserRoles
{
    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param $request
     * @param Closure $next
     * @param $roles
     *
     * @return mixed
     *
     * @throws InvalidRolesException
     */
    public function handle($request, Closure $next, $roles)
    {
        if (!$this->auth->user()->hasRole($roles, true)) {
            throw new InvalidRolesException(trans('exception.invalid_role_exception'));
        }

        return $next($request);
    }
}
