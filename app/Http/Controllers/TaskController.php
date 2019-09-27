<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Order;
use App\Services\Tasks\TaskStoreService;
use App\Services\Tasks\TaskIndexService;
use App\Services\Tasks\TaskUpdateService;
use App\Http\Requests\Tasks\TaskStoreRequest;

class TaskController extends Controller
{
    protected $storeService, $indexService, $updateService;

    /**
     * TaskController constructor.
     * @param TaskStoreService $storeService
     */
    public function __construct(
        TaskStoreService $storeService,
        TaskIndexService $indexService,
        TaskUpdateService $updateService
    )
    {
        $this->storeService = $storeService;
        $this->indexService = $indexService;
        $this->updateService = $updateService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Order $order, TaskIndexService $indexService)
    {
        if(request()->ajax()) {
            return $indexService->handle($order, request());
        }

        return view('tasks.index', compact('order'));
    }

    /**
     * Store a task
     * @param Order $order
     * @param TaskStoreRequest $request
     * @return mixed
     */
    public function store(Order $order, TaskStoreRequest $request)
    {
        return $this->storeService->handle($order, $request->validated());
    }

    /**
     * Update a task
     * @param $order
     * @param Task $task
     * @return mixed
     */
    public function update($order, Task $task)
    {
        return $this->updateService->handle($task, request()->all());
    }
}
