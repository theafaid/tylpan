<?php

namespace App\Services\Tasks;

use App\Eloquent\Tasks;
use App\Events\Tasks\TaskUpdated;

class TaskUpdateService
{
    protected $tasks;

    public function __construct(Tasks $tasks)
    {
        $this->tasks = $tasks;
    }

    /**
     * Handle updating a single task
     * Task is already loaded with founder and founder.profile
     * @param $task
     * @param $data
     * @return mixed
     */
    public function handle($task, $data)
    {
        $this->tasks->update($task, $data);

        if(general_settings('allow_notifications')) {
            event(new TaskUpdated($task));
        }

        return $task;
    }
}
