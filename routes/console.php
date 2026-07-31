<?php

use App\Models\ConnectionLog;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command('servers:monitor')->everyFifteenMinutes();

Schedule::call(function () {
    ConnectionLog::where('status', 'pending')
        ->where('created_at', '<', now()->subMinutes(5))
        ->update([
            'status' => 'failed',
            'error' => 'Connection initialization timed out (background worker failed to start).',
        ]);
})->hourly();

Schedule::command('telescope:prune')->hourly();