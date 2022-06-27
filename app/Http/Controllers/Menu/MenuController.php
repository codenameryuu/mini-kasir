<?php

namespace App\Http\Controllers\Menu;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Services\Menu\MenuService;

class MenuController extends Controller
{
    /**
     * Service instance.
     *
     * @var \App\Services\Menu\MenuService
     */
    protected $menuService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }

    /**
     * Index.
     */
    public function index()
    {
        $data = $this->menuService->index();

        return view('menu.index', [
            'title' => 'Mini Kasir',
            'description' => '',
            'keywords' => '',
            'menuName' => 'Menu',
            'menu' => $data->menu,
        ]);
    }
}
