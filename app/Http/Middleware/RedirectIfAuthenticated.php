<?php

namespace Keep\Http\Middleware;

use Closure;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param          $request
     * @param callable|Closure $next
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        if (auth()->check()) {
            return redirect()->home();
        }

        return $next($request);
    }
}
