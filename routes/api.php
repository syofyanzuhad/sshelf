<?php

use App\Http\Controllers\Api\V1\QuickCommandController;
use App\Http\Controllers\Api\V1\ServerController;
use App\Http\Controllers\Api\V1\SshKeyController;
use App\Http\Controllers\Api\V1\TagController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Proxy Dispatcher for Terminal (Internal use only)
Route::post('worker/spawn-terminal', function (Request $request) {
    $serverId = $request->integer('server_id');
    $logId = $request->integer('log_id');
    $token = $request->header('X-Internal-Token');

    // Simple shared secret for internal communication
    if ($token !== config('sshelf.internal_token')) {
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    $php = config('app.php_binary', 'php');
    if (str_contains($php, 'fpm')) {
        $php = str_replace('fpm', 'cli', $php);
    }

    $artisan = base_path('artisan');
    $command = "\"{$php}\" \"{$artisan}\" app:ssh-terminal {$serverId} --log-id={$logId} > /dev/null 2>&1 &";

    exec($command);

    return response()->json(['status' => 'spawned']);
})->withoutMiddleware(['api']);

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
