<?php

use App\Models\Server;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('server.{id}', function ($user, $id) {
    // Both admins and viewers (for their servers) can access terminal
    if ($user->isAdmin()) {
        return true;
    }

    return Server::where('id', $id)->where('user_id', $user->id)->exists();
});

Broadcast::channel('servers.health', function ($user) {
    return true; // Any authenticated user can listen to server health
});
