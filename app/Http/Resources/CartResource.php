<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
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
            'uuid' => $this->uuid,
            'taxes' => $this->taxes,
            'shippment' => $this->shipment,
            'discount' => $this->discount,
            'subtotal_price' => $this->subtotal_price,
            'total_price' => $this->total_price,
            'user' => $this->when($this->user, function () {
                return new UserResource($this->user);
            }, null),
            'coupon' => $this->when($this->coupon, function () {
                return new CouponResource($this->coupon);
            }, null),
            'lines' => CartLineResource::collection($this->lines),
        ];
    }
}
