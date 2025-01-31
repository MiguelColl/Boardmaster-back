<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        \Log::info('POST - /checkout - Store a newly created order in storage');
        return response()->json(
            [
                'error' => false,
                'msg' => 'Store a newly created order in storage'
            ],
            201
        );
    }
}
