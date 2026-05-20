<?php

use App\Models\Server;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('server.{id}', function ($user, $id) {
    return Server::where('id', $id)->where('user_id', $user->id)->exists();
});
