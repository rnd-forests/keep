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
        if (!($this->auth->check() && $user->can($permissions, true))) {
            throw new InvalidPermissionsException($user->name .
                ' does not have the required permissions to perform this request.');
        }

        return $next($request);
    }
}
