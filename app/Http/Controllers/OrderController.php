<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Caching\Countries;
use App\Services\OrderStoreService;
use App\Services\Orders\OrderShowService;
use App\Http\Requests\Orders\OrderStoreRequest;

class OrderController extends Controller
{
    protected $storeService, $showService;

    public function __construct(OrderStoreService $storeService, OrderShowService $showService)
    {
        $this->middleware('profile-completed', ['except' => ['index', 'show']]);

        $this->storeService = $storeService;
        $this->showService = $showService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('orders.index', [
            'orders' => auth()->user()->orders
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('orders.create', [
            'countries' => resolve(Countries::class)->allowedTravelTo()
        ]);
    }

    /**
     * Store a new order
     * @param OrderStoreRequest $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function store(OrderStoreRequest $request)
    {
        return $this->storeService->handle($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param  Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $this->authorize('view', $order);

        return view('orders.show', $this->showService->handleData($order));
    }
}
