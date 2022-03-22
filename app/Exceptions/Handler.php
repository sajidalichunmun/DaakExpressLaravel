<?php

namespace App\Exceptions;

use Exception;
use  ErrorException;
use Throwable;
//use Symfony\Component\Debug\Exception\FatalErrorException;

use  FatalErrorException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
    // public function report(Exception $exception)
    // {
    //     parent::report($exception);
    // }
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof ModelNotFoundException ) {
            
            abort(404);
            //$exception = new NotFoundHttpException($exception->getMessage(), $exception);
        }

          if ($exception instanceof FatalErrorException ) {
            
            abort(500);
            //$exception = new NotFoundHttpException($exception->getMessage(), $exception);
        }    if ($exception instanceof  ErrorException ) {
            
           
            //abort(501);
            //$exception = new NotFoundHttpException($exception->getMessage(), $exception);
        }



        if ($exception instanceof TokenMismatchException) {

            Session::flash('message','You page session expired. Please try to login again');

            return redirect()->route('login');
            //('error_message', 'You page session expired. Please try to login again');
        }

       // if ($exception instanceof  ErrorException ) {
            
          //  abort(403);
            //$exception = new NotFoundHttpException($exception->getMessage(), $exception);
        //}

        return parent::render($request, $exception);
    }
    //public function render($request, Throwable $exception);
    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    // public function render($request, Exception $exception)
    // {
    //     if ($exception instanceof ModelNotFoundException ) {
            
    //         abort(404);
    //         //$exception = new NotFoundHttpException($exception->getMessage(), $exception);
    //     }

    //       if ($exception instanceof FatalErrorException ) {
            
    //         abort(500);
    //         //$exception = new NotFoundHttpException($exception->getMessage(), $exception);
    //     }    if ($exception instanceof  ErrorException ) {
            
           
    //         //abort(501);
    //         //$exception = new NotFoundHttpException($exception->getMessage(), $exception);
    //     }



    //     if ($exception instanceof TokenMismatchException) {

    //         Session::flash('message','You page session expired. Please try to login again');

    //         return redirect()->route('login');
    //         //('error_message', 'You page session expired. Please try to login again');
    //     }

    //    // if ($exception instanceof  ErrorException ) {
            
    //       //  abort(403);
    //         //$exception = new NotFoundHttpException($exception->getMessage(), $exception);
    //     //}

    //     return parent::render($request, $exception);
    // }

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

        return redirect()->guest(route('login'));
    }
}