<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($request->ajax() || $request->wantsJson()) {

            // this part is from render function in Illuminate\Foundation\Exceptions\Handler.php
            // works well for json
            $exception = $this->prepareException($exception);
            if ($exception instanceof \Illuminate\Http\Exception\HttpResponseException) {
                return $exception->getResponse();
            } elseif ($exception instanceof \Illuminate\Auth\AuthenticationException) {
                return $this->unauthenticated($request, $exception);
            } elseif ($exception instanceof \Illuminate\Validation\ValidationException) {
                return $this->convertValidationExceptionToResponse($exception, $request);
            }

            // we look for assigned status code if there isn't we assign 500
            $statusCode = method_exists($exception, 'getStatusCode')
                ? $exception->getStatusCode()
                : 500;

            //we set prompt information based on status code
            switch ($statusCode) {
                case 404:
                    $errorMsg = "Sorry, the page you are looking for could not be found.";break;
                default:
                    $errorMsg = "Whoops, looks like something went wrong.";break;
            }

            // we prepare custom response for other situation such as modelnotfound
            $response = [];
            $response['error']['message'] = $errorMsg;
            $response['error']['http_code'] = $statusCode;
            if(config('app.debug')) {
                $response['debug']['error'] = $exception->getMessage();
                $response['debug']['trace'] = $exception->getTrace();
                $response['debug']['code'] = $exception->getCode();
            }

            return response()->json($response, $statusCode);
        }

        return parent::render($request, $exception);
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest('login');
    }
}
