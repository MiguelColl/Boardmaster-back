<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $orderBy = $request->input('orderBy', null);
        $sort = $request->input('sort', 'asc');

        $category = Category::where([
            'id' => $id,
            'node_type' => 'category'
        ])->active()
        ->first();

        if ($category) {
            $category->models = $this->getModels($category, $orderBy, $sort);
        }

        return response()->json(
            [
                'error' => !isset($category),
                'message' => $category ? '' : 'Not found',
                'data' => $category
            ],
            $category ? 200 : 404
        );
    }

    /**
     * Display a category by a given url.
     */
    public function showByUrl(Request $request)
    {
        $url = $request->post('url', '');
        $orderBy = $request->input('orderBy', null);
        $sort = $request->input('sort', 'asc');

        if (!$url) {
            return response()->json(
                [
                    'error' => true,
                    'message' => 'Not valid url'
                ],
                400
            );
        }

        $category = Category::where([
            'url' => $url,
            'node_type' => 'category'
        ])->active()
            ->first();

        if ($category) {
            $category->models = $this->getModels($category, $orderBy, $sort);
        }

        return response()->json(
            [
                'error' => !isset($category),
                'message' => $category ? '' : 'Not found',
                'data' => $category
            ],
            $category ? 200 : 404
        );
    }

    private function getModels($category, $orderBy, $sort)
    {
        $models = Category::filterModels($category->path, $orderBy, $sort)
            ->paginate(10);

        $data = $models->getCollection()->pluck('model');
        $models->setCollection($data);

        return $models;
    }
}
