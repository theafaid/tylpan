<?php

namespace App\Listeners\OrderDelegate;

use App\Events\Orders\DelegateAssigned;
//use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\Orders\DelegateAssigned as Notification;

class NotifyOrderCreator implements ShouldQueue
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
     * @param  DelegateAssigned  $event
     * @return void
     */
    public function handle(DelegateAssigned $event)
    {
        $event->order->owner->notify(
            new Notification($event->delegate, $event->order, $forDelegate = false)
        );
    }
}
