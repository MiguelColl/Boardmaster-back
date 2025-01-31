<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        \Log::info('POST - /newsletter - Store a newly created newsletter in storage');
        return response()->json(
            [
                'error' => false,
                'msg' => 'Store a newly created newsletter in storage'
            ],
            201
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        \Log::info('DELETE - /newsletter/ - Remove the specific newsletter from storage');
        return response()->json(
            [
                'error' => false,
                'msg' => 'Remove the specific newsletter from storage'
            ],
            204
        );
    }
}
