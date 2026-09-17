<?php

namespace App\Exceptions;

use App\Constants\StatusCode;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\PostTooLargeException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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

    public function render($request, Throwable $exception)
    {

        if ($exception instanceof ModelNotFoundException && $request->wantsJson()) {

            return response()->error(
                trans('Model Entity with the given UUID not found'),
                'Model Entity with the given UUID not found',
                StatusCode::NOT_FOUND
            );
        }

        if ($exception instanceof NotFoundHttpException && $request->wantsJson()) {

            return response()->error(
                trans('Route Not Found - 404'),
                'Route Not Found - 404',
                StatusCode::NOT_FOUND
            );
        }

        if ($exception instanceof PostTooLargeException && $request->wantsJson()) {

            return response()->error(
                trans('File Exceeded max file size.'),
                'File Exceeded max file size.',
                StatusCode::NOT_FOUND
            );
        }

        if ($exception instanceof AuthenticationException && $request->wantsJson()) {

            return response()->error(
                trans('Unauthenticated'),
                'Unauthenticated',
                StatusCode::UNAUTHORIZED
            );
        }

        if ($exception instanceof ValidationException && $request->wantsJson()) {

            return response()->error(
                $exception->getMessage(),
                $exception->getMessage(),
                StatusCode::BAD_REQUEST
            );
        }
        return parent::render($request, $exception);
    }
}
