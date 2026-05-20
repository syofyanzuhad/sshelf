<?php

use App\Livewire\Servers\ConnectionLogs;
use App\Livewire\Servers\ServerTerminal;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');
Route::view('compare', 'compare')->name('compare');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::get('servers/{server}/terminal', ServerTerminal::class)->name('servers.terminal');
    Route::get('logs', ConnectionLogs::class)->name('servers.logs');
});

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
