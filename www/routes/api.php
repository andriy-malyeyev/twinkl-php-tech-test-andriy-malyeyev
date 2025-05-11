<?php

declare(strict_types=1);

use App\Http\Controllers\API\Subscription\SignUpController;
use App\Http\Middleware\API\Subscription\SignUpAccessCheckMiddleware;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'subscription'], static function () {
    Route::post('signup', [SignUpController::class, 'store'])->middleware(SignUpAccessCheckMiddleware::class);
});
