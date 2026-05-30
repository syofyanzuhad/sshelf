<?php

use App\Http\Controllers\DesktopLoginController;
use App\Livewire\Servers\ConnectionLogs;
use App\Livewire\Servers\ServerTerminal;
use App\Livewire\Settings\ApiTokens;
use App\Livewire\Settings\QuickCommands;
use App\Livewire\Settings\SshKeys;
use App\Livewire\Settings\Subscription;
use App\Livewire\Settings\SystemDiagnostics;
use App\Livewire\Settings\Users;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');
Route::view('features', 'features')->name('features');
Route::view('compare', 'compare')->name('compare');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('desktop/login', DesktopLoginController::class)->name('desktop.login');
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::get('servers/{server}/terminal', ServerTerminal::class)->name('servers.terminal');
    Route::get('logs', ConnectionLogs::class)->name('servers.logs');
    Route::get('commands', QuickCommands::class)->name('commands');
    Route::get('keys', SshKeys::class)->name('keys');
    Route::get('users', Users::class)->name('users');
    Route::get('tokens', ApiTokens::class)->name('tokens');
    Route::get('diagnostics', SystemDiagnostics::class)->name('system.diagnostics');
    Route::get('subscription', Subscription::class)->name('subscription');
});

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
