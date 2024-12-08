<?php

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

    Route::apiResource('products', ProductController::class);

    Route::apiResource('categories', CategoryController::class);

    Route::prefix('entrer')->group(function () {
        Route::post('products/stock', [EnterproductController::class, 'store']);
        Route::get('/stock/statistique', [EnterproductController::class, 'statistique']);
        Route::get('/stock/statistique/period', [EnterproductController::class, 'statistiquePeriodique']);
    });

    Route::prefix('sorties')->group(function () {
        Route::post('products/stock', [OutproductController::class, 'store']);
        Route::get('/stock/statistique', [OutproductController::class, 'statistique']);
        Route::get('/stock/statistique/period', [OutproductController::class, 'statistiquePeriodique']);
    });

});

