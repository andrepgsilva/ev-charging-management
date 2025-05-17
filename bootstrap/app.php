<?php

declare(strict_types=1);

use App\Http\Middleware\ForceJsonHeaderResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        commands: __DIR__ . '/../routes/console.php',
        using: function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/company.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append(ForceJsonHeaderResponse::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (ValidationException $e, Request $request) {
            return response()->json(
                [
                    'status' => false,
                    'message' => 'Validation Error',
                    'errors' => $e->validator->errors()->toArray(),
                ],
                422
            );
        });
    })->create();
