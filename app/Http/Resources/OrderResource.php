<?php

namespace App\Http\Resources;

use App\Enums\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'unique_id' => $this->unique_id,
            'email' => $this->email,
            'delivery' => [
                'name' => $this->delivery_name,
                'surname' => $this->delivery_surname,
                'address' => $this->delivery_address,
                'zipcode' => $this->delivery_zipcode,
                'province' => $this->delivery_province,
                'country' => $this->delivery_country,
                'phone' => $this->delivery_phone,
                'comments' => $this->delivery_comments,
            ],
            'bill' => [
                'name' => $this->bill_name,
                'surname' => $this->bill_surname,
                'address' => $this->bill_address,
                'zipcode' => $this->bill_zipcode,
                'province' => $this->bill_province,
                'country' => $this->bill_country,
                'identity_card' => $this->bill_identity_card,
                'fiscal_name' => $this->bill_fiscal_name,
            ],
            'payment' => [
                'method' => $this->payment_method,
                'paid' => $this->paid,
                'paid_at' => $this->paid_at,
                'total_price' => $this->total_price,
                'tax_price' => $this->tax_price,
                'subtotal_price' => $this->subtotal_price,
                'shipping_price' => $this->shipping_price,
                'shipping_tax' => $this->shipping_tax,
                'discounted_price' => $this->discounted_price,
            ],
            'coupon' => new CouponResource($this->coupon),
            'status' => [
                'id' => $this->status,
                'label' => OrderStatus::from($this->status)->name,
            ],
            'items' => OrderLineResource::collection($this->lines),
        ];
    }
}
