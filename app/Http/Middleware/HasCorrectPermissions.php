<?php
namespace Keep\Http\Middleware;

use App;
use Closure;
use Keep\Exceptions\NotAuthorizedException;

class HasCorrectPermissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     * @throws NotAuthorizedException
     */
    public function handle($request, Closure $next)
    {
        $auth = App::make('Illuminate\Contracts\Auth\Guard');
        $user = $auth->user();
        $action = $request->route()->getAction();
        if (array_key_exists('permissions', $action)) {
            if ( ! ($auth->check() && $user->ability([], $action['permissions']))) {
                throw new NotAuthorizedException($user->name . ' does not have the required permission(s) to perform this request.');
            }
        }

        return $next($request);
    }
}
