<?php

namespace App\Http\Controllers;

use App\Http\Resources\MenuResource;
use App\Models\Menu;
use Illuminate\Support\Facades\Cache;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Cache::remember('menu', config('constants.cache.long'), function () {
            $menus = Menu::base()->get();

            foreach ($menus as $menu) {
                $items = Menu::subMenu($menu->path)->get();
                $menu->items = MenuResource::collection($items);
            }

            return MenuResource::collection($menus);
        });
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Cache::remember("menu_$id", config('constants.cache.long'), function () use ($id) {
            $menu = Menu::findOrFail($id);

            $items = Menu::subMenu($menu->path)->get();
            $menu->items = MenuResource::collection($items);

            return new MenuResource($menu);
        });
    }
}
