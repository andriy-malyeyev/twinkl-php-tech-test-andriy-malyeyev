<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Subscription;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SignUpController extends Controller
{
    /**
     * Handles the creation of a new subscription.
     *
     * @param  Request  $request  The request.
     * @return JsonResponse JSON response.
     */
    public function store(Request $request): JsonResponse
    {
        Subscription::create([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' => $request->get('email'),
            'role' => $request->get('role'),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Subscription created successfully.',
        ], Response::HTTP_CREATED);
    }
}
