<?php

namespace App\Services\Orders;

use App\Events\Chats\ChatEvent;
use Illuminate\Support\Facades\Cache;

class OrderChatService
{
    /**
     * @param $order
     * @param $message
     */
    public function send($order, $message)
    {
        $this->cacheNewChat($order, $this->oldChat($order), $message);

        if(general_settings('allow_notifications')) {
            $this->broadcast($order, $message);
        }
    }

    /**
     * @param $order
     * @return array
     */
    public function get($order)
    {
        return Cache::get("order.{$order->code}.chat") ?: [];
    }

    /**
     * @param $chat
     * @param $message
     * @return array
     */
    protected function newChat($chat, $message)
    {
        $chat[] =  [
            'message' => $message,
            'user' => $this->handleUser(),
            'time' => now()->diffForHumans(),
        ];

        return $chat;
    }

    /**
     * @param $order
     * @param $oldChat
     * @param $message
     */
    protected function cacheNewChat($order, $oldChat, $message)
    {
        Cache::put("order.{$order->code}.chat", $this->newChat($oldChat, $message), now()->addDays(15));
    }

    /**
     * @param $order
     * @param $message
     */
    protected function broadcast($order, $message)
    {
        event(new ChatEvent($message, $this->handleUser(), $order));
    }

    /**
     * @return array
     */
    protected function handleUser()
    {
        return ['name' => auth()->user()->fullName, 'avatar' => auth()->user()->profile->formattedAvatar];
    }

    /**
     * @param $order
     * @return array
     */
    protected function oldChat($order)
    {
        return Cache::get("order.{$order->code}.chat") ?: [];
    }
}
