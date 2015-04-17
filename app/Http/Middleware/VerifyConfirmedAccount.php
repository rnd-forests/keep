<?php namespace Keep\Http\Middleware;

use App;
use Closure;

class VerifyConfirmedAccount {

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

        if ( ! $auth->user()->isConfirmed())
        {
            flash()->warning('Confirm your email address before performing this action.');

            return redirect()->route('home');
        }

        return $next($request);
    }

}
