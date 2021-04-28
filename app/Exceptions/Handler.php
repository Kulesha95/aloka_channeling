<?php

namespace App\Exceptions;

use App\Helpers\ResponseHelper;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

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
        $this->renderable(function (Exception $exception, $request) {
            if ($request->is('api/*')) {
                $previousException = $exception->getPrevious();
                if ($previousException instanceof ModelNotFoundException) {
                    $modelName = ucfirst(
                        strtolower(
                            trim(
                                implode(
                                    ' ',
                                    preg_split(
                                        '/(?=[A-Z])/',
                                        str_replace(
                                            'App\\Models\\',
                                            '',
                                            $previousException->getModel()
                                        )
                                    )
                                )
                            )
                        )
                    );
                    return ResponseHelper::findFail($modelName);
                }
                if ($exception instanceof AuthenticationException) {
                    return ResponseHelper::unauthorized();
                }
                return ResponseHelper::error(
                    $exception->getMessage(),
                    []
                );
            }
        });
    }
}