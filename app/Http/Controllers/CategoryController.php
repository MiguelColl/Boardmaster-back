<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::where('id', $id)->first();
        \Log::info("GET - /category/$id - Display the specified category");
        return response()->json(
            [
                'error' => !isset($category),
                'msg' => 'Display the specified category',
                'data' => $category
            ],
            isset($category) ? 200 : 404
        );
    }

    /**
     * Display a category by a given url.
     */
    public function showByUrl()
    {
        \Log::info('POST - /category/byUrl - Display a category by a given url');
        return response()->json(
            [
                'error' => false,
                'msg' => 'Display a category by a given url'
            ],
            200
        );
    }
}
