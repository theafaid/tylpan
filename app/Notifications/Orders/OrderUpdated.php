<?php

namespace App\Notifications\Orders;

//use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
//use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class OrderUpdated extends Notification
{

    protected $order;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)->markdown('mail.orders.updated', [
            'order' => $this->order
        ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'message' => "We made some changes for order {$this->order->formattedCode}",
            'link' => route('orders.show', $this->order->code),
        ];
    }

    /**
     * @param $notifiable
     * @return array
     */
    public function toBroadcast($notifiable)
    {
        return [
            'id' => $notifiable->id,
            'data' => [
                'message' =>"We made some changes for order {$this->order->formattedCode}",
                'link' => route('orders.show', $this->order->code),
            ],
            'created_at' => now()->diffForHumans(),
        ];
    }
}
