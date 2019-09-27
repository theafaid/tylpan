<?php

namespace App\Http\Controllers;


use App\Models\Order;
use App\Services\Orders\OrderChatService;

class ChatController extends Controller
{
    /**
     * @var OrderChatService
     */
    protected $service;

    /**
     * ChatController constructor.
     * @param OrderChatService $service
     */
    public function __construct(OrderChatService $service)
    {
        $this->service = $service;
    }

    /**
     * @param Order $order
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function send(Order $order)
    {
        $this->authorize('view', $order);

        $this->service->send($order, request('message'));

        return response(request('message'), 200);
    }

    /**
     * @param Order $order
     * @return array
     */
    public function get(Order $order)
    {
        return $this->service->get($order);
    }
}
