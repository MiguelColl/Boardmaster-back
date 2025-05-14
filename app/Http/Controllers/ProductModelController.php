<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentResource;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Comment;
use App\Models\ProductModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class ProductModelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $filterNews = false)
    {
        $key = $filterNews ? 'new_products' : 'products';
        $page = $request->input('page', 1);
        $perPage = $request->input('perPage', config('constants.pagination'));
        $keyName = $key . "_page-$page" . "_perPage-$perPage";

        return Cache::remember($keyName, config('constants.cache.short'), function () use ($filterNews, $perPage) {
            $products =  ProductModel::loadRelations()
                ->active()
                ->orderBy('id');

            if ($filterNews) {
                $products->filterByNews();
            }

            return new ProductCollection($products->paginate($perPage));
        });
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $result = Cache::remember("product_$id", config('constants.cache.short'), function () use ($id) {
            return ProductModel::where('id', $id)
                ->loadRelations()
                ->active()
                ->first();
        });

        $result->numVisits = $this->checkNumVisits($id);
        return $result ? new ProductResource($result) : abort(404);
    }

    /**
     * Display a product model by a given url.
     */
    public function showByUrl(Request $request)
    {
        $url = $request->post('url', '');

        if (!$url) {
            abort(400);
        }

        $result =  Cache::remember("product_url_$url", config('constants.cache.short'), function () use ($url) {
            return ProductModel::where('url', $url)
                ->loadRelations()
                ->active()
                ->first();
        });

        $result->numVisits = $this->checkNumVisits($result['id']);
        return $result ? new ProductResource($result) : abort(404);
    }

    /**
     * Display a listing of the product model comments.
     */
    public function indexComment(string $id)
    {
        return Cache::remember("product_comments_$id", config('constants.cache.short'), function () use ($id) {
            $product = ProductModel::where('id', $id)
                ->with('comments', function ($q) {
                    $q->approved()->with(['user']);
                })->active()
                ->first();

            return $product ? CommentResource::collection($product->comments) : abort(404);
        });
    }

    /**
     * Store a product model comment.
     */
    public function storeComment(Request $request, string $id)
    {
        $product = ProductModel::findOrFail($id);

        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'comment' => ['required', 'string'],
            'rate' => ['required', 'integer', 'min:1', 'max:5'],
        ]);

        $comment = Comment::create([
            'user_id' => Auth::user()->id,
            'product_model_id' => $product->id,
            'title' => $request->title,
            'comment' => $request->comment,
            'rate' => $request->rate,
        ]);

        return new CommentResource($comment);
    }

    private function checkNumVisits($productId)
    {
        $numVisits = "visits_product_$productId";
        if (!Redis::exists($numVisits)) {
            $seconds = Carbon::now()->diffInSeconds(Carbon::now()->endOfDay());
            Redis::set($numVisits, 0, 'EX', $seconds);
        }

        return Redis::incr($numVisits);
    }
}
