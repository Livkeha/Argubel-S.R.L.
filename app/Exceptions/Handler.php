<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Redirect;
use Session;
use URL;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];


        /**
         * Render an exception into an HTTP response.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  \Exception  $exception
         * @return \Illuminate\Http\Response
         */
         public function render($request, Exception $exception)
         {

             if ($exception instanceof \Illuminate\Http\Exceptions\PostTooLargeException)

              {

                $errorPeso = ("El peso de cada foto no debe superar los 10MB.");

                 Session::flash('pesoMaximo', "El peso de cada foto no debe superar los 10MB.");

                 return redirect()->back()->withErrors(compact('errorPeso'));

              }

             return parent::render($request, $exception);
         }

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

}
