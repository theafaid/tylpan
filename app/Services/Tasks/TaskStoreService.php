<?php

namespace App\Services\Tasks;

use App\Eloquent\Orders;
use App\Events\Tasks\TaskCreated;

class TaskStoreService
{
    protected $orders;

    public function __construct(Orders $orders)
    {
        $this->orders = $orders;
    }

    /**
     * Handle storing a new task
     * @param $order
     * @param $data
     * @param null $user
     * @return mixed
     */
    public function handle($order, $data, $user = null)
    {
        $user = $user ?: auth()->user();

        $task = $this->orders->addTask($order, $data, $user);

        if(general_settings('allow_notifications')) {
            event(new TaskCreated($task));
        }

        return $task->load(['founder', 'founder.profile']);
    }
}
