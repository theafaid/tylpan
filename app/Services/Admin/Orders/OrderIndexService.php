<?php

namespace App\Services\Admin\Orders;

use App\Models\Order;

class  OrderIndexService
{
    protected $with = ['owner', 'owner.country', 'delegate'];

    /**
     * @param null $user
     * @return mixed
     */
    public function handle($user = null)
    {
        $user = $user ?: auth()->user() ;

        $orders = $user->isDelegate() ? $this->ordersForDelegate($user) : $this->allOrders();

        return $orders;
    }

    /**
     * Fetch assigned orders to a delegate
     * @param $delegate
     * @return mixed
     */
    protected function ordersForDelegate($delegate)
    {
        return Order::with($this->with)->assignedTo($delegate)->filter();
    }

    /**
     * Fetch all orders for admins
     * @return mixed
     */
    protected function allOrders()
    {
        return Order::with($this->with)->filter();
    }
}
