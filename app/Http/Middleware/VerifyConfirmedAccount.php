<?php namespace Keep\Http\Middleware;

use App;
use Closure;
use Keep\Exceptions\UnconfirmedAccountException;

class VerifyConfirmedAccount {

    /**
     * Handle an incoming request.
     *
     * @param          $request
     * @param callable $next
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws UnconfirmedAccountException
     */
    public function handle($request, Closure $next)
    {
        $auth = App::make('Illuminate\Contracts\Auth\Guard');

        if ( ! $auth->user()->isConfirmed())
        {
            throw new UnconfirmedAccountException('Confirm your account before taking this action.');
        }

        return $next($request);
    }

}
