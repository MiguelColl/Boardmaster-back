<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VariantResource extends JsonResource
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
            'sku' => $this->sku,
            'price' => $this->rate->discount_price ?? $this->rate->price,
            'price_initial' => $this->rate->price,
            'discount' => $this->calcDiscount($this->rate->price, $this->rate->discount_price),
            'color' => $this->color,
            'stock' => $this->stock->stock,
            'images' => $this->images,
        ];
    }

    private function calcDiscount($price, $discountPrice)
    {
        return $discountPrice ? 100 - round(($discountPrice * 100) / $price) : 0;
    }
}
