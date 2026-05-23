<?php

use App\Http\Controllers\Api\V1\QuickCommandController;
use App\Http\Controllers\Api\V1\ServerController;
use App\Http\Controllers\Api\V1\SshKeyController;
use App\Http\Controllers\Api\V1\TagController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->prefix('v1')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::apiResource('servers', ServerController::class);
    Route::post('servers/{server}/execute', [ServerController::class, 'execute']);

    Route::apiResource('ssh-keys', SshKeyController::class);
    Route::apiResource('tags', TagController::class);
    Route::apiResource('quick-commands', QuickCommandController::class);
});
