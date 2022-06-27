<?php

namespace App\Http\Controllers\Order;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Services\Order\OrderService;

class OrderController extends Controller
{
    /**
     * Service instance.
     *
     * @var \App\Services\Order\OrderService
     */
    protected $orderService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * Index.
     */
    public function index()
    {
        $result = $this->orderService->index();

        return view('order.index', [
            'title' => 'Mini Kasir',
            'description' => '',
            'keywords' => '',
            'menuName' => 'Pesanan',
            'order' => $result->order,
        ]);
    }

    /**
     * Detail.
     * 
     * @param  $id
     */
    public function show($id)
    {
        $result = $this->orderService->show($id);

        return view('order.show', [
            'title' => 'Mini Kasir',
            'description' => '',
            'keywords' => '',
            'menuName' => 'Pesanan',
            'order' => $result->order,
        ]);
    }

    /**
     * Update status.
     * 
     * @param  \App\Http\Requests\Request  $request
     */
    public function updateStatus(Request $request)
    {
        $result = $this->orderService->updateStatus($request);

        echo json_encode($result);
    }
}
