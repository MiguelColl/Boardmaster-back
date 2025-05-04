<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartLineResource extends JsonResource
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
            'product' => [
                'id' => $this->variant->id,
                'name' => $this->variant->model->name,
                'image' => $this->variant->images[0],
            ],
            'units' => $this->units,
            'base_price_per_unit' => $this->base_price_per_unit,
            'total_base_price' => $this->total_base_price,
            'price_per_unit' => $this->price_per_unit,
            'total_price' => $this->total_price,
            'tax_per_unit' => $this->tax_per_unit,
            'total_tax' => $this->total_tax,
        ];
    }
}
