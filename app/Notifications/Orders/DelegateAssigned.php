<?php

namespace App\Notifications\Orders;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
//use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class DelegateAssigned extends Notification
{
    use Queueable;

    protected $delegate, $order, $forDelegate;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($delegate, $order, $forDelegate = true)
    {
        $this->delegate = $delegate;
        $this->order = $order;
        $this->forDelegate = $forDelegate;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {

        return $this->forDelegate ? $this->delegateMail() : $this->creatorMail();
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'message' => $this->forDelegate ? 'New order assigned to you right now.' : 'Your order has assigned to a delegate.',
            'link' => route('orders.show', $this->order->code),
        ];
    }

    /**
     * Specific Mail for the delegate
     * @return MailMessage
     */
    protected function delegateMail()
    {
        return (new MailMessage)
            ->line("Hey {$this->delegate->defaultName}")
            ->line("You have been assigned to an order {$this->order->formattedCode} in {$this->order->ownerCountry()->name}")
            ->action('Start work on it now.', route('orders.show', $this->order->code))
            ->line('Thank you!');
    }

    /**
     * Specific Mail for order creator
     * @return MailMessage
     */
    protected function creatorMail()
    {
        return (new MailMessage)->markdown('mail.orders.delegate_assigned', [
            'order' => $this->order,
            'delegate' => $this->delegate,
        ]);
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
                'message' =>
                    $this->forDelegate ? 'New order assigned to you right now.' : "Your order is now assigned to a delegate exists in {$this->order->owner->country->name}",
                'link' => route('orders.show', $this->order->code),
            ],
            'created_at' => now()->diffForHumans(),
        ];
    }
}
