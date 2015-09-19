<?php

namespace Keep\Exceptions;

use Bugsnag;
use Exception;
use Bugsnag\BugsnagLaravel\BugsnagExceptionHandler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        'Symfony\Component\HttpKernel\Exception\HttpException',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception $e
     * @return void
     */
    public function report(Exception $e)
    {
        if (auth()->check()) {
            Bugsnag::setUser([
                'name' => auth()->user()->name,
                'email' => auth()->user()->email,
            ]);
        }

        return parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Exception $e
     *
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        switch (get_class_short_name($e)) {
            case 'InvalidUserException':
                flash()->warning($e->getMessage());

                return redirect()->home();

            case 'InvalidRolesException':
                flash()->warning($e->getMessage());

                return redirect()->home();

            case 'ModelNotFoundException':
                flash()->warning(trans('exception.model_not_found_exception', [
                    'model' => get_class_short_name($e->getModel()),
                ]));

                return redirect()->home();

            case 'NotFoundHttpException':
                flash()->warning(trans('exception.not_found_http_exception'));

                return redirect()->home();
        };

        return parent::render($request, $e);
    }
}
