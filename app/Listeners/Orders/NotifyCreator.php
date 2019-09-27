<?php

namespace App\Listeners\Orders;

use App\Notifications\Orders\OrderCreated as CreatedNotification;
use App\Notifications\Orders\OrderUpdated as UpdatedNotification;
//use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyCreator implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function handleOrderCreated($event)
    {
        $event->order->owner->notify(
            new CreatedNotification($event->order, $forAdmins = false)
        );
    }

    public function handleOrderUpdated($event)
    {
        $event->order->owner->notify(
            new UpdatedNotification($event->order)
        );
    }

    public function subscribe($events)
    {
        $events->listen(
            'App\Events\Orders\OrderCreated',
            'App\Listeners\Orders\NotifyCreator@handleOrderCreated'
        );

        $events->listen(
            'App\Events\Orders\OrderUpdated',
            'App\Listeners\Orders\NotifyCreator@handleOrderUpdated'
        );
    }
}
