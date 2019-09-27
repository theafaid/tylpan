<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Caching\Countries;
use App\Http\Controllers\Controller;
use App\Services\Admin\Orders\OrderIndexService;
use App\Http\Requests\Admin\Orders\OrderUpdateRequest;
use App\Services\Admin\Orders\OrderUpdateService;

class OrderController extends Controller
{
    protected $indexService, $updateService;

    public function __construct(OrderIndexService $indexService, OrderUpdateService $updateService)
    {
        $this->indexService = $indexService;
        $this->updateService = $updateService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(request()->expectsJson()) {
            return response(['collection' => $this->indexService->handle()], 200);
        }
        return view('admin.orders.index');
    }

    /**
     * Show the form for editing the specified resource.
     * @param Order $order
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Order $order)
    {
        return view('admin.orders.edit', [
            'order' => $order,
            'countries' => resolve(Countries::class)->allowedTravelTo()
        ]);
    }


    /**
     * Update the specified resource in storage.
     * @param Order $order
     * @param OrderUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Order $order, OrderUpdateRequest $request)
    {
        $this->updateService->handle($order, array_merge($request->validated(), ['basic' => $request->basic]));

        session()->flash('success', 'Order Updated Successfully');

        return redirect()->route('admin.orders.edit', $order->code);
    }

    /**
     * Destroy an order
     * @param Order $order
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return response([], 204);
    }
}
