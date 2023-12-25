<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Throwable;
use App\Base\Responses\apiResponse;


class Handler extends ExceptionHandler
{
    use apiResponse;

    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e)
    {
//        if ($e instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
//            return $this->failed(trans('api.notFound'), [
//                'model' => $e->getMessage()
//            ],404);
//        }
//
//        // return json response
//        if($request->is('api/*')){
//            if ($e instanceof \Illuminate\Auth\AuthenticationException) {
//                return $this->failed(trans('api.youAreNotAuthorized'), [
//                    'auth' => $e->getMessage()
//                ], 401);
//            }
//        }

        return parent::render($request,$e);
}
}
