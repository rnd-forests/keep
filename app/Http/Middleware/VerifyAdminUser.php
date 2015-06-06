<?php
namespace Keep\Http\Middleware;

use App;
use Closure;
use Keep\Exceptions\InvalidAdminUserException;

class VerifyAdminUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     * @throws InvalidAdminUserException
     */
    public function handle($request, Closure $next)
    {
        $auth = App::make('Illuminate\Contracts\Auth\Guard');
        if ( ! $auth->user()->isAdmin()) {
            throw new InvalidAdminUserException('This area is for administrators only.');
        }

        return $next($request);
    }
}
