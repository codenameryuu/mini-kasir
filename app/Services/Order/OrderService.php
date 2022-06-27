<?php

namespace App\Services\Order;

use App\Models\Order;
use App\Models\OrderDetail;

class OrderService
{
    /**
     * Index service.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return  ArrayObject
     */
    public function index()
    {
        $order = Order::orderBy('created_at', 'desc')->get();

        $status = true;
        $message = 'Data berhasil diambil !';

        $result = (object) [
            'status' => $status,
            'message' => $message,
            'order' => $order,
        ];

        return $result;
    }

    /**
     * Detail service.
     *
     * @param  $id
     * @return  ArrayObject
     */
    public function show($id)
    {
        $order = OrderDetail::with(['order', 'menu'])
            ->where('order_id', $id)->get();

        $status = true;
        $message = 'Data berhasil diambil !';

        $result = (object) [
            'status' => $status,
            'message' => $message,
            'order' => $order,
        ];

        return $result;
    }

    /**
     * Update status service.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return  ArrayObject
     */
    public function updateStatus($request)
    {
        $data = [
            'status' => $request->status,
        ];

        Order::where('id', $request->id)->update($data);

        $order = Order::firstWhere('id', $request->id);

        $status = true;
        $message = 'Data berhasil diubah !';

        $result = (object) [
            'status' => $status,
            'message' => $message,
            'order' => $order,
        ];

        return $result;
    }
}
