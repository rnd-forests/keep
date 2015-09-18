<?php

namespace Keep\Entities\Concerns\Auth;

use Illuminate\Http\Request;
use Illuminate\Cache\RateLimiter;

class ThrottlesLogins
{
    protected $limiter;

    public function __construct(RateLimiter $limiter)
    {
        $this->limiter = $limiter;
    }

    /**
     * Check if too many failed login attempts have been made.
     *
     * @param Request $request
     *
     * @return bool
     */
    public function hasTooManyLoginAttempts(Request $request)
    {
        return $this->limiter->tooManyAttempts(
            $request->input($this->loginUsername()).$request->ip(),
            $this->maxLoginAttempts(), $this->lockoutTime() / 60
        );
    }

    /**
     * Increment the login attempts.
     *
     * @param Request $request
     */
    public function incrementLoginAttempts(Request $request)
    {
        $this->limiter->hit(
            $request->input($this->loginUsername()).$request->ip()
        );
    }

    /**
     * When the maximum login attempts has been reached. Lockout the user.
     *
     * @param Request $request
     *
     * @return $this
     */
    public function sendLockoutResponse(Request $request)
    {
        $seconds = $this->limiter->availableIn(
            $request->input($this->loginUsername()).$request->ip()
        );

        return redirect($this->loginPath())
            ->withInput($request->only($this->loginUsername(), 'remember'))
            ->withErrors([
                $this->loginUsername() => $this->getLockoutErrorMessage($seconds),
            ]);
    }

    /**
     * Clear the login attempts.
     *
     * @param Request $request
     */
    public function clearLoginAttempts(Request $request)
    {
        $this->limiter->clear(
            $request->input($this->loginUsername()).$request->ip()
        );
    }

    /**
     * Get the login lockout error message.
     *
     * @param $seconds
     *
     * @return string
     */
    protected function getLockoutErrorMessage($seconds)
    {
        return trans('authentication.throttle', ['seconds' => $seconds]);
    }

    /**
     * Get the attribute used as login username.
     *
     * @return mixed
     */
    protected function loginUsername()
    {
        return config('throttling.login_username');
    }

    /**
     * Get the maximum number of login attempts.
     *
     * @return mixed
     */
    protected function maxLoginAttempts()
    {
        return config('throttling.max_login_attempts');
    }

    /**
     * The number of seconds to delay further login attempts.
     *
     * @return mixed
     */
    protected function lockoutTime()
    {
        return config('throttling.lockout_time');
    }

    /**
     * Get the login path.
     *
     * @return mixed
     */
    protected function loginPath()
    {
        return config('throttling.login_path');
    }
}
