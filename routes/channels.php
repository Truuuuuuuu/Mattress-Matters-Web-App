<?php

use Illuminate\Support\Facades\Broadcast;

// Register the broadcasting auth routes (/broadcasting/auth, /broadcasting/user-auth)
// so Laravel Echo can authorize private/presence channel subscriptions.
// In production you may want to add middleware like ['auth', 'auth:sanctum'] if using API tokens.
Broadcast::routes();

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('chat.{id1}.{id2}', function ($user, $id1, $id2) {
    return in_array($user->id, [(int)$id1, (int)$id2]);
});
