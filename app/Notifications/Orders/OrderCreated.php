<?php

namespace App\Notifications\Orders;

//use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
//use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class OrderCreated extends Notification
{

    protected $order, $forAdmins;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($order, $forAdmins = true)
    {
        $this->order = $order;
        $this->forAdmins = $forAdmins;
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
        return $this->forAdmins ? $this->adminMail() : $this->creatorMail();


    }

    /**
     * Handle a mail for admins
     * @return MailMessage
     */
    protected function adminMail()
    {
        return (new MailMessage)
            ->line('New order has created in our site.')
            ->action('View It.', url("/orders/{$this->order->code}"));
    }

    /**
     * Handle a mail for order creator
     * @return MailMessage
     */
    protected function creatorMail()
    {
        return (new MailMessage)->markdown('mail.orders.created', [
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
            'message' => $this->forAdmins ? 'New Order Created' : 'Your order is now in progress',
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
                'message' => $this->forAdmins ? 'New Order Created Right Now.' : 'Your order is now in progress',
                'link' => route('orders.show', $this->order->code),
            ],
            'created_at' => now()->diffForHumans(),
        ];
    }
}
