<?php

namespace App\Services\Tasks;

use App\Eloquent\Tasks;

class TaskIndexService
{
    protected $tasks;

    /**
     * TaskIndexService constructor.
     * @param Tasks $tasks
     */
    public function __construct(Tasks $tasks)
    {
        $this->tasks = $tasks;
    }

    /**
     * @param $order
     * @param $request
     * @return mixed
     */
    public function handle($order, $request)
    {

        if(auth()->user()->isDefaultUser()) {
            $data['tasks'] = $this->tasks->fetch($order, true);

            return $data;
        }

        $data['tasks'] = $this->tasks->fetch($order, $request->me ? true : false);


        $data['order_owner_id'] = $order->user_id;
        $data['order_delegate_id'] = $order->delegate_id;
        $data['delegate_assignor_id'] = $order->delegate_assigned_by;

        return $data;
    }
}
