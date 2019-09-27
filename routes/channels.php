<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('order.created', function ($user) {
    return $user->isAdmin();
});

Broadcast::channel('order.{order}.chat', function ($user, $order) {
    $order = \App\Models\Order::findOrFail($order);
    return $order->ownedBy($user) || $user->isAdmin() || $order->delegate_id == $user->id;
});
