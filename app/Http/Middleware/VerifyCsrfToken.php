<?php
namespace Keep\Http\Middleware;

use Closure;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    protected $excludedPaths = [
        'queue/receive',
    ];

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param callable                 $next
     *
     * @return \Illuminate\Http\Response
     * @throws TokenMismatchException
     */
    public function handle($request, Closure $next)
    {
        $regex = '#' . implode('|', $this->excludedPaths) . '#';
        if ($this->isReading($request) or $this->tokensMatch($request)
            or preg_match($regex, $request->path())
        ) {
            return $this->addCookieToResponse($request, $next($request));
        }
        throw new TokenMismatchException;
    }
}
