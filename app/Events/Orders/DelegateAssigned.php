<?php

namespace App\Events\Orders;

use App\Models\User;
use App\Models\Order;
//use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
//use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class DelegateAssigned
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $delegate, $order;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $delegate, Order $order)
    {
        $this->delegate = $delegate;
        $this->order = $order;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel("Orders.DelegateAssigned");
    }

}
