<?php

namespace Tests\Feature;

use App\Models\Invitation;
use App\Models\Server;
use App\Models\User;
use Illuminate\Support\Facades\Config;
use Livewire\Volt\Volt;

use function Pest\Laravel\actingAs;

beforeEach(function () {
    Config::set('sshelf.mode', 'saas');
});

test('in saas mode users are admins of their own space', function () {
    $user = User::factory()->create(['parent_id' => null]);

    $this->assertTrue($user->isAdmin());
    $this->assertNull($user->parent_id);
});

test('in saas mode users only see their own servers', function () {
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();

    Server::factory()->create(['user_id' => $user1->id, 'name' => 'User 1 Server']);
    Server::factory()->create(['user_id' => $user2->id, 'name' => 'User 2 Server']);

    actingAs($user1);

    // Global scope should hide server2
    $this->assertEquals(1, Server::count());
    $this->assertEquals('User 1 Server', Server::first()->name);
});

test('in saas mode members see their parent servers', function () {
    $owner = User::factory()->create();
    $member = User::factory()->create(['parent_id' => $owner->id]);

    Server::factory()->create(['user_id' => $owner->id, 'name' => 'Owner Server']);

    actingAs($member);

    $this->assertEquals($owner->id, $member->owner()->id);
    $this->assertEquals(1, Server::count());
    $this->assertEquals('Owner Server', Server::first()->name);
});

test('registration with invitation link sets parent_id', function () {
    $owner = User::factory()->create();
    $invitation = Invitation::create([
        'user_id' => $owner->id,
        'role' => 'viewer',
    ]);

    Volt::test('pages.auth.register', ['invitation' => $invitation->token])
        ->set('name', 'New Member')
        ->set('email', 'member@example.com')
        ->set('password', 'password')
        ->set('password_confirmation', 'password')
        ->call('register');

    $member = User::where('email', 'member@example.com')->first();

    $this->assertNotNull($member);
    $this->assertEquals($owner->id, $member->parent_id);
    $this->assertTrue($member->isMember());
});
