<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'url' => $this->url,
            'images' => $this->images,
            'isNew' => $this->isNewProduct($this->created_at),
            'description' => $this->description,
            'brand' => $this->brand,
            'products' => VariantResource::collection($this->variants),
        ];
    }

    private function isNewProduct($createdDate)
    {
        $date = Carbon::parse($createdDate)->utc()->startOfDay();
        return $date->diffInDays(Carbon::now()->startOfDay(), true) <= 30;
    }
}
