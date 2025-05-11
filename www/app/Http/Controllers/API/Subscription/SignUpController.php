<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Subscription;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Subscription\SignUpRequest;
use App\Models\Subscription;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class SignUpController extends Controller
{
    /**
     * Handles the creation of a new subscription.
     *
     * @param  SignUpRequest  $request  The validated request containing subscription details.
     * @return JsonResponse JSON response.
     */
    public function store(SignUpRequest $request): JsonResponse
    {
        Subscription::create([
            'first_name' => $request->validated('first_name'),
            'last_name' => $request->validated('last_name'),
            'email' => $request->validated('email'),
            'role' => $request->validated('role'),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Subscription created successfully.',
        ], Response::HTTP_CREATED);
    }
}
