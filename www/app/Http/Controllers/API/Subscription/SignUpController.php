<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Subscription;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class SignUpController extends Controller
{
    /**
     * Handles the creation of a new subscription.
     *
     * @return JsonResponse JSON response.
     */
    public function store(): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Subscription created successfully.',
        ], Response::HTTP_CREATED);
    }
}
