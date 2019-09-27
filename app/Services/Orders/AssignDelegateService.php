<?php

namespace App\Services\Orders;

use App\Eloquent\Orders;
use App\Events\Orders\DelegateAssigned;

class AssignDelegateService
{
    /**
     * AssignDelegateService constructor.
     * @param Orders $orders
     */
    public function __construct(Orders $orders)
    {
        $this->orders = $orders;
    }

    /**
     * Assign an order to a delegate
     * @param $order
     * @param $payload
     */
    public function assign($order, $payload)
    {
        $delegate = $this->orders->assignTo($order, $payload['delegate_id']);

        if(general_settings('allow_notifications')) {
            event(new DelegateAssigned($delegate, $order));
        }
    }

    /**
     * Dismiss the order delegator
     * @param $order
     */
    public function dismiss($order)
    {
        $this->orders->dismissDelegateFrom($order);
    }
}
