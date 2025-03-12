<?php

namespace App\Http\Controllers;

use App\Http\Resources\MenuResource;
use App\Models\Menu;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = Menu::base()->get();

        foreach ($menus as $menu) {
            $items = Menu::subMenu($menu->path)->get();
            $menu->items = MenuResource::collection($items);
        }

        return MenuResource::collection($menus);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $menu = Menu::findOrFail($id);

        $items = Menu::subMenu($menu->path)->get();
        $menu->items = MenuResource::collection($items);

        return new MenuResource($menu);
    }
}
