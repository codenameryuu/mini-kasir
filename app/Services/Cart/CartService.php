<?php

namespace App\Services\Cart;

use Darryldecode\Cart\Facades\CartFacade as Cart;

use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderDetail;

class CartService
{
    /**
     * Index service.
     *
     * @return  ArrayObject
     */
    public function index()
    {
        $cart = Cart::getContent();
        $total = Cart::getSubTotal();

        $status = true;
        $message = 'Data berhasil diambil !';

        $result = (object) [
            'status' => $status,
            'message' => $message,
            'cart' => $cart,
            'total' => $total,
        ];

        return $result;
    }

    /**
     * Store service.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return  ArrayObject
     */
    public function store($request)
    {
        $now = date('Y-m-d H:i:s');

        $cart = Cart::getContent();
        $total = Cart::getSubTotal();
        $total = intval($total);

        $order = Order::create([
            'transaction_code' => '',
            'datetime' => $now,
            'buyer_name' => $request->name,
            'total' => $total,
        ]);

        if ($order->id < 10) {
            $transactionCode = 'INV-00' . $order->id;
        } else if ($order->id < 100) {
            $transactionCode = 'INV-0' . $order->id;
        } else {
            $transactionCode = 'INV-' . $order->id;
        }

        $data = [
            'transaction_code' => $transactionCode,
        ];

        Order::where('id', $order->id)->update($data);

        foreach ($cart as $row) {
            $data = [
                'order_id' => $order->id,
                'menu_id' => $row->id,
                'price' => $row->price,
                'quantity' => $row->quantity,
            ];

            OrderDetail::create($data);
        }

        Cart::clear();

        $status = true;
        $statusAlert = 'success';
        $message = 'Data berhasil ditambah !';

        $result = (object) [
            'status' => $status,
            'statusAlert' => $statusAlert,
            'message' => $message,
        ];

        return $result;
    }

    /**
     * Add item service.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return  ArrayObject
     */
    public function addItem($request)
    {
        $menu = Menu::firstWhere('id', $request->id);

        Cart::add([
            'id' => $menu->id,
            'name' => $menu->name,
            'price' => $menu->price,
            'quantity' => 1,
            'attributes' => array(
                'image' => $menu->image,
            )
        ]);

        $status = true;
        $message = 'Berhasil menambahkan ke keranjang !';

        $result = (object) [
            'status' => $status,
            'message' => $message,
            'menu' => $menu,
        ];

        return $result;
    }

    /**
     * Update item service.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return  ArrayObject
     */
    public function updateItem($request)
    {
        $quantity = $request->quantity - 1;
        $quantityView = number_format($quantity, 0, ',', '.');

        Cart::update($request->id, [
            'quantity' => -1,
        ]);

        $total = Cart::getSubTotal();

        $cart = [
            'id' => $request->id,
            'quantity' => $quantity,
            'quantityView' => $quantityView,
            'total' => $total,
        ];

        $status = true;
        $message = 'Berhasil mengubah ke keranjang !';

        $result = (object) [
            'status' => $status,
            'message' => $message,
            'cart' => $cart,
        ];

        return $result;
    }

    /**
     * Delete item service.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return  ArrayObject
     */
    public function deleteItem($request)
    {
        Cart::remove($request->id);
        $total = Cart::getSubTotal();

        $cart = [
            'id' => $request->id,
            'total' => $total,
        ];

        $status = true;
        $message = 'Berhasil menghapus ke keranjang !';

        $result = (object) [
            'status' => $status,
            'message' => $message,
            'cart' => $cart,
        ];

        return $result;
    }
}
