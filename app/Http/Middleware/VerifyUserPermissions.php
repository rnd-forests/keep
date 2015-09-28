<?php

namespace Keep\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Keep\Exceptions\InvalidPermissionsException;

class VerifyUserPermissions
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
     * @param $permissions
     * @return mixed
     * @throws InvalidPermissionsException
     */
    public function handle($request, Closure $next, $permissions)
    {
        $user = $this->auth->user();
        if (!($this->auth->check() && $user->canDo($permissions, true))) {
            throw new InvalidPermissionsException(trans('exception.invalid_permission_exception', [
                'user' => $user->name,
            ]));
        }

        return $next($request);
    }
}
