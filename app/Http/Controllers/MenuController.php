<?php

namespace App\Http\Controllers;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        \Log::info('GET - /menu/ - Display a listing of the menu');
        return response()->json(
            [
                'error' => false,
                'msg' => 'Display a listing of the menu'
            ],
            200
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        \Log::info("GET - /menu/$id - Display the specified menu");
        return response()->json(
            [
                'error' => false,
                'msg' => 'Display the specified menu'
            ],
            200
        );
    }
}
