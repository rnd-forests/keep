<?php namespace Keep\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Keep\Repositories\User\UserRepositoryInterface;

class RedirectIfNotCorrectUser {

    protected $auth, $userRepository;

    /**
     * Constructor.
     *
     * @param Guard                   $auth
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(Guard $auth, UserRepositoryInterface $userRepository)
    {
        $this->auth = $auth;
        $this->userRepository = $userRepository;
    }

    /**
     * Handle an incoming request.
     * This middleware is responsible to check if the current authenticated
     * user is the same as the user in the currently requesting route.
     *
     * @param          $request
     * @param callable $next
     *
     * @return \Illuminate\Http\RedirectResponse
     */
	public function handle($request, Closure $next)
	{
        $user = $this->userRepository->findBySlug($request->route('users'));

        if (($user->id != $this->auth->user()->id))
        {
            flash()->warning('You has no right to access this page.');

            return redirect()->route('home_path');
        }

		return $next($request);
	}

}
