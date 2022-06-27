<?php

namespace App\Services\Menu;

use App\Models\Menu;

class MenuService
{
    /**
     * Index service.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return  ArrayObject
     */
    public function index()
    {
        $paginate = 8;
        $menu = Menu::orderBy('name', 'asc')->paginate($paginate);

        $status = true;
        $message = 'Data berhasil diambil !';

        $result = (object) [
            'status' => $status,
            'message' => $message,
            'menu' => $menu,
        ];

        return $result;
    }
}
