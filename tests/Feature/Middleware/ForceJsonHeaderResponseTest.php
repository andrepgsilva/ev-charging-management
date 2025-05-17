<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\ForceJsonHeaderResponse;

beforeEach(function () {
    Route::middleware([ForceJsonHeaderResponse::class])->any('/test-json-middleware', function () {
        return response(['message' => 'ok']);
    });
});

it('forces Accept header to application/json', function () {
    $response = $this->get('/test-json-middleware', [
        'Accept' => 'text/html',
    ]);

    $response->assertHeader('Content-Type', 'application/json');
    $response->assertJson(['message' => 'ok']);
});

it('does not remove existing application/json Accept header', function () {
    $response = $this->get('/test-json-middleware', [
        'Accept' => 'application/json',
    ]);

    $response->assertHeader('Content-Type', 'application/json');
    $response->assertJson(['message' => 'ok']);
});
