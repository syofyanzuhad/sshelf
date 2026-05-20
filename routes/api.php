<?php

use App\Http\Controllers\Api\V1\ServerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->prefix('v1')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::apiResource('servers', ServerController::class)->only(['index', 'show']);
    Route::post('servers/{server}/execute', [ServerController::class, 'execute']);
});
