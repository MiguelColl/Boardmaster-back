<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    private static $allCategories = null;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'num_visits_today' => $this->when(isset($this->numVisits), $this->numVisits),
            'name' => $this->name,
            'url' => $this->url,
            'images' => $this->images,
            'isNew' => $this->isNewProduct($this->created_at),
            'description' => $this->description,
            'brand' => $this->brand,
            'numPlayers' => $this->numPlayers,
            'ratings' => $this->when($this->comments->isNotEmpty(), function () {
                $commentsRatings = $this->comments->pluck('rate')->toArray();

                return [
                    'total' => count($commentsRatings),
                    'average' => round(array_sum($commentsRatings) / count($commentsRatings), 1),
                ];
            }, null),
            'variants' => VariantResource::collection($this->variants),
            'categories' => $this->category->map(function ($catAssociation) {
                if (self::$allCategories === null) {
                    self::$allCategories = \App\Models\Category::where('node_type', 'category')
                        ->active()
                        ->get();
                }

                $modelPath = $catAssociation->path;

                return self::$allCategories->filter(function ($c) use ($modelPath) {
                    return str_starts_with($modelPath, $c->path . '.');
                })->map(function ($c) {
                    return [
                        'name' => $c->name,
                        'url' => $c->url,
                    ];
                });
            })->collapse()->unique('url')->values()->toArray(),
        ];
    }

    private function isNewProduct($createdDate)
    {
        $date = Carbon::parse($createdDate)->utc()->startOfDay();
        return $date->diffInDays(Carbon::now()->startOfDay(), true) <= 30;
    }
}
