<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponses
{
    protected function ok(string $message, mixed $data = []): JsonResponse
    {
        return $this->success($message, $data);
    }

    protected function success(string $message, mixed $data = [], int $statusCode = 200): JsonResponse
    {
        return response()->json([
            'data' => $data,
            'message' => $message,
            'status' => $statusCode,
        ], $statusCode);
    }
}
