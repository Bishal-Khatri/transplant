<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
//        $this->renderable(function (NotFoundHttpException $exception, $request){
//            if ($request->expectsJson()){
//                return response()->json([
//                    'error' => true,
//                    'message' => $exception->getMessage(),
//                    'data' => [],
//                    'meta' => []
//                ], 404);
//            }
//        });
//        $this->renderable(function (Throwable $exception, $request){
//            if ($request->expectsJson()){
//                return response()->json([
//                    'error' => true,
//                    'message' => $exception->getMessage(),
//                    'data' => [],
//                    'meta' => []
//                ], 404);
//            }
//        });
//        $this->renderable(function (ModelNotFoundException $e, $request) {
//            dd('sdf');
////            Log::channel('slack')->info($e->getMessage(), $log);
//            if ($request->wantsJson()) {
//                dd('sdf');
//                return response()->json([
//                    'message' => 'Record not found.'
//                ], 404);
//            }
//        });
//        $this->renderable(function (\Exception $e) {

//            $log = [
//                'file' => $e->getFile(),
//                'line' => $e->getLine(),
//                'code' => $e->getCode(),
//                'previous' => $e->getPrevious(),
//            ];
//            Log::channel('slack')->info($e->getMessage(), []);
//            return response()->json([
//                'error' => true,
//                'message' => 'General Error',
//                'data' => [],
//                'meta' => []
//            ]);
//        });


    }
}
