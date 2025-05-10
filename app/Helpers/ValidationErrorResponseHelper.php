<?php

declare(strict_types=1);

namespace App\Helpers;

use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

final class ValidationErrorResponseHelper
{
    public static function execute(
        ValidationException $validationException,
        string $message = 'Validation Error',
        int $statusCode = 422,
    ): JsonResponse {
        return response()->json([
            'status' => false,
            'message' => $message,
            'errors' => $validationException->validator->errors()->toArray(),
        ], $statusCode);
    }
}
