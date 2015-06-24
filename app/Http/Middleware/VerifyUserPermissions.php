<?php
namespace Keep\Http\Middleware;

use Closure;
use Keep\Exceptions\InvalidPermissionsException;

class VerifyUserPermissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @param                           $permissions
     *
     * @return mixed
     * @throws InvalidPermissionsException
     */
    public function handle($request, Closure $next, $permissions)
    {
        $user = auth()->user();
        if (! (auth()->check() && $user->can($permissions, true))) {
            throw new InvalidPermissionsException($user->name .
                ' does not have the required permissions to perform this request.');
        }

        return $next($request);
    }
}
