<?php

namespace App\Eloquent;


use App\Models\Task;

class Tasks
{
    protected $task;

    /**
     * Tasks constructor.
     * @param Task $task
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
     * Fetch tasks for a specific order according to (whose)
     * @param $order
     * @param bool $me
     * @return mixed
     */
    public function fetch($order, $me = false)
    {
        return $this->task
            ->where('order_id', $order->id)
            ->where('task_for', $me ? auth()->id() : $order->user_id)
            ->get();
    }

    /**
     * Update a single task
     * @param $task
     * @param $data
     * @return mixed
     */
    public function update($task, $data)
    {
        return $task->update($data);
    }
}
