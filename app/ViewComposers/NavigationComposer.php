<?php

namespace App\ViewComposers;

use Illuminate\View\View;

class NavigationComposer
{
    /**
     * @param View $view
     * @return View
     */
    public function compose(View $view)
    {
        if(! $user = auth()->user()) return;

        return $view->with('notifications', $this->userNotifications($user));
    }

    /**
     * Get formatted authentication user notifications
     * @param $user
     * @return \Illuminate\Support\Collection
     */
    protected function userNotifications($user)
    {
        return collect($user->unreadNotifications)->map(function ($notification) {
            return [
                'id' => $notification->id,
                'data' => $notification->data,
                'created_at' => $notification->created_at->diffForHumans()
            ];
        });
    }
}
