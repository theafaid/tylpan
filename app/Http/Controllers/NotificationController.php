<?php

namespace App\Http\Controllers;

class NotificationController extends Controller
{
    public function markAsRead($id)
    {
        $notification = auth()->user()->unreadNotifications()->find($id);

        $notification ? $notification->delete() : null;

        return response([], 204);
    }
}
