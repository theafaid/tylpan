<?php

namespace App\Services;

use App\Eloquent\Orders;
use App\Events\Orders\OrderCreated;

class OrderStoreService
{
    protected $order;

    /**
     * OrderStoreService constructor.
     * @param Orders $orders
     */
    public function __construct(Orders $orders)
    {
        $this->orders = $orders;
    }


    /**
     * Store an order
     * @param array $data
     * @param null $user
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function handle(array $data, $user = null)
    {
        $user = $user ?: auth()->user();

        // First of all i have stored the order in orders table
        $order = $this->orders->store($user, $data);

        // Second i will assign the countries to this order
        $this->orders->assignCountries($order, $data['countries']);

        // Third i will assign the universities to this order
        $this->orders->assignUniversities($order, $data['universities']);

        // Fourth notify. Only If notification is allowed
        if(general_settings('allow_notifications'))
        {
            event(new OrderCreated($order));
        }

        return response(['msg' => 'You order has created successfully.'], 201);
    }
}
