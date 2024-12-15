<?php

use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EnterproductController;
use App\Http\Controllers\OutproductController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {

    Route::prefix('auth')->group(function () {
        Route::post('login', [AuthController::class, 'login']);
        Route::post('register', [AuthController::class, 'register']);
        Route::delete('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
    });


    Route::apiResource('products', ProductController::class)->middleware('auth:sanctum');

    Route::apiResource('categories', CategoryController::class)->middleware('auth:sanctum');

    Route::prefix('entrer')->group(function () {
        Route::post('products/stock', [EnterproductController::class, 'store'])->middleware('auth:sanctum');
        Route::get('stock/statistique', [EnterproductController::class, 'statistique'])->middleware('auth:sanctum');
        Route::get('stock/statistique/period', [EnterproductController::class, 'statistiquePeriodique'])->middleware('auth:sanctum');
    })->middleware('auth:sanctum');

    Route::prefix('sorties')->group(function () {
        Route::post('products/stock', [OutproductController::class, 'store'])->middleware('auth:sanctum');
        Route::get('stock/statistique', [OutproductController::class, 'statistique'])->middleware('auth:sanctum');
        Route::get('stock/statistique/period', [OutproductController::class, 'statistiquePeriodique'])->middleware('auth:sanctum');
    })->middleware('auth:sanctum');

});

