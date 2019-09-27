<?php

namespace App\Notifications\Tasks;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
//use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class TaskUpdated extends Notification
{
    use Queueable;

    protected $task;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($task)
    {
        $this->task = $task;
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
        return (new MailMessage)
                    ->line("Task on order {$this->task->order->formattedCode} which created by {$this->task->founder->defaultName} has been updated")
                    ->action('See Task', route('tasks.index', $this->task->order->code))
                    ->line('Thank you!');
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
            'message' => "Task Updated in order {$this->task->order->formattedCode}.",
            'link' => route('tasks.show', $this->task->order->code),
            'created_at' => $this->task->created_at->diffForHumans(),
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
                'message' => "Task Updated in order {$this->task->order->formattedCode}.",
                'link' => route('tasks.show', $this->task->order->code),
            ],
            'created_at' => now()->diffForHumans(),
        ];
    }
}
