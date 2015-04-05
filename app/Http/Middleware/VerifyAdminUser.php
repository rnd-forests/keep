<?php namespace Keep\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class VerifyAdminUser {

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
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
        if (! $this->auth->user()->isAdmin())
        {
            flash()->warning('This area is for administrators only. You have no right to access it.');

            return redirect()->route('home_path');
        }

		return $next($request);
	}

}
