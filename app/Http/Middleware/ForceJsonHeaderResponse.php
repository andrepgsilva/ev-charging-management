<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

final class ForceJsonHeaderResponse
{
    public function handle(Request $request, Closure $next): Response|JsonResponse
    {
        /** @var Response|JsonResponse $response */
        $response = $next($request);

        if (! $response->headers->has('Content-Type')) {
            $response->headers->set('Content-Type', 'application/json');
        }

        return $response;
    }
}
