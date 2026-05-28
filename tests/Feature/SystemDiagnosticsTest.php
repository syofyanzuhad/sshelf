<?php

use App\Models\User;
use App\Enums\UserRole;
use Livewire\Volt\Volt;
use App\Livewire\Settings\SystemDiagnostics;
use function Pest\Laravel\{actingAs, get};

test('diagnostics page is restricted to admins', function () {
    $user = User::factory()->create(['role' => UserRole::Viewer]);

    actingAs($user)
        ->get(route('system.diagnostics'))
        ->assertForbidden();
});

test('admins can see diagnostics page', function () {
    $admin = User::factory()->create(['role' => UserRole::Admin]);

    actingAs($admin)
        ->get(route('system.diagnostics'))
        ->assertOk()
        ->assertSee('System Health Check');
});

test('diagnostics component runs checks', function () {
    $admin = User::factory()->create(['role' => UserRole::Admin]);

    actingAs($admin);

    Livewire::test(SystemDiagnostics::class)
        ->assertSet('checks.environment.label', 'PHP Version')
        ->assertSet('checks.functions.label', 'Required Functions')
        ->assertSee('PHP Version');
});
