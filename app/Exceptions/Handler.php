<?php

namespace App\Exceptions;

use Exception;
use FastRoute\BadRouteException;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
//
//        if ($exception instanceof BadRouteException) {
//            $array = [
//                "status" => 400,
//                "message" => "Internal Server Error, Please check the request link" . env('DOCUMENT_LINK'),
//                "errors" => [
//                    'code' => $exception->getCode(),
//                    'message' => $exception->getMessage(),
//                    'file' => $exception->getFile()
//                ],
//            ];
//            return response()->json($array);
//        }
//        if ($exception instanceof NotFoundHttpException | $exception instanceof MethodNotAllowedHttpException) {
//            $array = [
//                "status" => 500,
//                "message" => "Internal Server Error, Please check the request link" . env('DOCUMENT_LINK'),
//                "errors" => [
//                    'code' => $exception->getCode(),
//                    'message' => $exception->getMessage(),
//                    'file' => $exception->getFile()
//                ],
//            ];
//            return response()->json($array);
//        }
        $array = [
            "status" => 500,
            "message" => "Internal Server Error",
            "errors" => [
                'code' => $exception->getCode(),
                'message' => $exception->getMessage(),
//                'file' => $exception->getFile()
            ],
        ];
        return response()->json($array);
//        return parent::render($request, $exception);
    }
}
