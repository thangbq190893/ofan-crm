<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResources([
        'products' => App\Http\Controllers\ProductController::class,
        'orders' => App\Http\Controllers\OrderController::class,
        'customers' => App\Http\Controllers\CustomerController::class,
    ]);
});
