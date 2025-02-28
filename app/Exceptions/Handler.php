<?php

namespace App\Exceptions;

use App\Http\Controllers\SiteController;
use App\Models\ErrorLoger;
use App\Models\Testmonial;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Validation\ValidationException::class,
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
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     *
     * @throws \Exception
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
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function render($request, Exception $exception)
    {
        $tests = Testmonial::all();
        ErrorLoger::create(
            [
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'error' => $exception->getMessage(),
                'request' => request()->all(),
                'method' => request()->method(),
                'url' => request()->url(),
            ]
        );
        if ($this->isHttpException($exception)) {
            if (view()->exists('site.error.error' . $exception->getStatusCode())) {
                return response()->view('site.error.error' . $exception->getStatusCode(), SiteController::GData(), $exception->getStatusCode());
            }
        }
        return parent::render($request, $exception);

    }
}
