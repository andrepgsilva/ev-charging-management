<?php

declare(strict_types=1);

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Middleware\ForceJsonHeaderResponse;

it('adds Content-Type header when not present', function () {
    $middleware = new ForceJsonHeaderResponse();
    $request = new Request();

    $response = new Response();
    $next = fn () => $response;

    $result = $middleware->handle($request, $next);

    expect($result->headers->get('Content-Type'))->toBe('application/json');
});

it('preserves existing Content-Type header', function () {
    $middleware = new ForceJsonHeaderResponse();
    $request = new Request();

    $response = new Response();
    $response->headers->set('Content-Type', 'text/plain');
    $next = fn () => $response;

    $result = $middleware->handle($request, $next);

    expect($result->headers->get('Content-Type'))->toBe('text/plain');
});

it('returns the same response instance', function () {
    $middleware = new ForceJsonHeaderResponse();
    $request = new Request();

    $response = new Response();
    $next = fn () => $response;

    $result = $middleware->handle($request, $next);

    expect($result)->toBe($response);
});
