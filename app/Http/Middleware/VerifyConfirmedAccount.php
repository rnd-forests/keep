<?php namespace Keep\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class VerifyConfirmedAccount {

    protected $auth;

    /**
     * Constructor.
     *
     * @param Guard $auth
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

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
        if (! $this->auth->user()->isConfirmed())
        {
            flash()->warning('Confirm your email address before taking this action.');

            return redirect()->route('home_path');
        }

		return $next($request);
	}

}
