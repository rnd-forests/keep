<?php namespace Keep\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler {

    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        'Symfony\Component\HttpKernel\Exception\HttpException'
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception $e
     *
     * @return void
     */
    public function report(Exception $e)
    {
        return parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception               $e
     *
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        if ($e instanceof InvalidUserException)
        {
            flash()->warning($e->getMessage());

            return redirect()->home();
        }

        if ($e instanceof InvalidAdminUserException)
        {
            flash()->warning($e->getMessage());

            return redirect()->home();
        }

        if ($e instanceof UnconfirmedAccountException)
        {
            flash()->warning($e->getMessage());

            return redirect()->route('login');
        }

        if ($e instanceof ModelNotFoundException)
        {
            flash()->warning('The ' . substr($e->getModel(), 14) . ' you are looking for, cannot be found.');

            return redirect()->home();
        }

        return parent::render($request, $e);
    }

}
