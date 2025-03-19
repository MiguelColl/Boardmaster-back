<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $orderBy = $request->input('orderBy', null);
        $sort = $request->input('sort', 'asc');
        $page = $request->input('page', 1);

        return Cache::remember("category_$id-$sort-$page-$orderBy", config('constants.cache.short'), function () use ($id, $orderBy, $sort) {
            $category = Category::where([
                'id' => $id,
                'node_type' => 'category'
            ])->active()
            ->first();

            if ($category) {
                $category->models = $this->getModels($category, $orderBy, $sort);
            }

            return $category ? new CategoryResource($category) : abort(404);
        });
    }

    /**
     * Display a category by a given url.
     */
    public function showByUrl(Request $request)
    {
        $url = $request->post('url', '');
        $orderBy = $request->input('orderBy', null);
        $sort = $request->input('sort', 'asc');
        $page = $request->input('page', 1);

        if (!$url) {
            return abort(400);
        }

        return Cache::remember("category_$url-$sort-$page-$orderBy", config('constants.cache.short'), function () use ($url, $orderBy, $sort) {
            $category = Category::where([
                'url' => $url,
                'node_type' => 'category'
            ])->active()
                ->first();

            if ($category) {
                $category->models = $this->getModels($category, $orderBy, $sort);
            }

            return $category ? new CategoryResource($category) : abort(404);
        });
    }

    private function getModels($category, $orderBy, $sort)
    {
        $models = Category::filterModels($category->path, $orderBy, $sort)
            ->paginate(config('constants.pagination'));

        $data = $models->getCollection()->pluck('model');
        $models->setCollection($data);

        return $models;
    }
}
