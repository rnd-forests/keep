<?php namespace Keep\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
// use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Bugsnag\BugsnagLaravel\BugsnagExceptionHandler as ExceptionHandler;

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

        if ($e instanceof NotFoundHttpException)
        {
            flash()->warning('The URL you are looking for cannot be found.');

            return redirect()->home();
        }

        return parent::render($request, $e);
    }

}
