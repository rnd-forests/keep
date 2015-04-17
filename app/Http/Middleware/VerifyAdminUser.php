<?php namespace Keep\Http\Middleware;

use App;
use Closure;

class VerifyAdminUser {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $auth = App::make('Illuminate\Contracts\Auth\Guard');

        if ( ! $auth->user()->isAdmin())
        {
            flash()->warning('This area is for administrators only. You have no right to access it.');

            return redirect()->route('home');
        }

        return $next($request);
    }

}
