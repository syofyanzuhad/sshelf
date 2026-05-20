<?php

use App\Livewire\Servers\ServerTerminal;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');
Route::view('compare', 'compare')->name('compare');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('servers/{server}/terminal', ServerTerminal::class)
    ->middleware(['auth', 'verified'])
    ->name('servers.terminal');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
