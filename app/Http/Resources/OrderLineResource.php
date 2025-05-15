<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderLineResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'product' => [
                'name' => $this->name,
                'sku' => $this->sku,
                'image' => $this->image,
                'color' => $this->color,
            ],
            'units' => $this->units,
            'price_unit' => $this->price_unit,
            'price_unit_base' => $this->price_unit_base,
            'price_total' => $this->price_total,
            'price_total_base' => $this->price_total_base,
            'original_price' => $this->original_price,
            'tax_value' => $this->tax_value,
            'tax_unit' => $this->tax_unit,
            'tax_total' => $this->tax_total,
        ];
    }
}
