<?php namespace Keep\Http\Middleware;

use App;
use Closure;

class Authenticate {

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

		if ($auth->guest())
		{
			if ($request->ajax())
			{
				return response('Unauthorized.', 401);
			}
			else
			{
				return redirect()->guest('auth/login');
			}
		}

		return $next($request);
	}

}
