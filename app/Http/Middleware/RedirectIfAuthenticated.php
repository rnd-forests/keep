<?php
namespace Keep\Http\Middleware;

use App;
use Closure;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param          $request
     * @param callable $next
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        $auth = App::make('Illuminate\Contracts\Auth\Guard');
        if ($auth->check()) {
            return redirect()->home();
        }

        return $next($request);
    }
}
