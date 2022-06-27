<?php

namespace App\Http\Controllers\Cart;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Services\Cart\CartService;

class CartController extends Controller
{
    /**
     * Service instance.
     *
     * @var \App\Services\Cart\CartService
     */
    protected $cartService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * Index.
     */
    public function index()
    {
        $result = $this->cartService->index();

        return view('cart.index', [
            'title' => 'Mini Kasir',
            'description' => '',
            'keywords' => '',
            'menuName' => 'Keranjang',
            'cart' => $result->cart,
            'total' => $result->total,
        ]);
    }

    /**
     * Store.
     * 
     * @param  \App\Http\Requests\Request  $request
     */
    public function store(Request $request)
    {
        $result = $this->cartService->store($request);

        return redirect()->back()->with($result->statusAlert, $result->message);
    }

    /**
     * Add item.
     * 
     * @param  \App\Http\Requests\Request  $request
     */
    public function addItem(Request $request)
    {
        $result = $this->cartService->addItem($request);

        echo json_encode($result);
    }

    /**
     * Update item.
     * 
     * @param  \App\Http\Requests\Request  $request
     */
    public function updateItem(Request $request)
    {
        $result = $this->cartService->updateItem($request);

        echo json_encode($result);
    }

    /**
     * Delete item.
     * 
     * @param  \App\Http\Requests\Request  $request
     */
    public function deleteItem(Request $request)
    {
        $result = $this->cartService->deleteItem($request);

        echo json_encode($result);
    }
}
