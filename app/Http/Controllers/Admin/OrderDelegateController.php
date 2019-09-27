<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Http\Controllers\Controller;
use App\Services\Orders\AssignDelegateService;
use App\Http\Requests\AssignOrderDelegateRequest;

class OrderDelegateController extends Controller
{
    protected $service;

    /**
     * OrderDelegateController constructor.
     * @param AssignDelegateService $service
     */
    public function __construct(AssignDelegateService $service)
    {
        $this->service = $service;
    }

    /**
     * Assign a delegate to an order
     * @param Order $order
     * @param AssignOrderDelegateRequest $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function assign(Order $order, AssignOrderDelegateRequest $request)
    {
        $this->service->assign($order, $request->validated());

        return $this->success();
    }

    /**
     * Dismiss assigned delegate for an order
     * @param Order $order
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function dismiss(Order $order)
    {
        $this->service->dismiss($order);

        return $this->success();
    }

    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    protected function success()
    {
        return response(['message' => 'Order updated successfully'], 200);
    }
}
