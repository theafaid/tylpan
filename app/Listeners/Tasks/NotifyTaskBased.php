<?php

namespace App\Listeners\Tasks;

//use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\Tasks\TaskCreated as CreatedNotification;
use App\Notifications\Tasks\TaskUpdated as UpdatedNotification;

class NotifyTaskBased implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function handleTaskCreated($event)
    {
        $event->task->taskBased->notify(
            new CreatedNotification($event->task)
        );
    }

    public function handleTaskUpdated($event)
    {
        $event->task->taskBased->notify(
        new UpdatedNotification($event->task)
    );
    }

    public function subscribe($events)
    {
        $events->listen(
            'App\Events\Tasks\TaskCreated',
            'App\Listeners\Tasks\NotifyTaskBased@handleTaskCreated'
        );

        $events->listen(
            'App\Events\Tasks\TaskUpdated',
            'App\Listeners\Tasks\NotifyTaskBased@handleTaskUpdated'
        );
    }
}
