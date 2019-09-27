<?php

namespace App\Listeners\Orders;

use App\Models\User;
use App\Events\Orders\OrderCreated;
//use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\Orders\OrderCreated as Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyAdmins implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  OrderCreated  $event
     * @return void
     */
    public function handle(OrderCreated $event)
    {
        User::admins()->get()->each(function ($admin) use ($event) {
            $admin->notify(
                (new Notification($event->order))
            );
        });
    }
}
