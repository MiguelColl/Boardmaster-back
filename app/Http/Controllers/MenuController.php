<?php

namespace App\Http\Controllers;

use App\Http\Resources\MenuResource;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $menuType = $request->input('type') ?: 'header';

        return Cache::remember("menu_$menuType", config('constants.cache.long'), function () use ($menuType) {
            $menus = Menu::base($menuType)->orderBy('norder')->get();

            foreach ($menus as $menu) {
                $items = Menu::subMenu($menu->path, $menuType)->orderBy('norder')->get();
                $menu->items = MenuResource::collection($items);
            }

            return MenuResource::collection($menus);
        });
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $menuType = $request->input('type', 'header');

        return Cache::remember("menu_$menuType-$id", config('constants.cache.long'), function () use ($id, $menuType) {
            $menu = Menu::findOrFail($id);

            $items = Menu::subMenu($menu->path, $menuType)->get();
            $menu->items = MenuResource::collection($items);

            return new MenuResource($menu);
        });
    }
}
