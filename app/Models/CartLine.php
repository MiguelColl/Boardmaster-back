<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartLine extends Model
{
    protected $table = 'cart_lines';
    protected $guarded = [];

    protected $casts = [
        'base_price_per_unit' => 'float',
        'total_base_price' => 'float',
        'price_per_unit' => 'float',
        'total_price' => 'float',
        'tax_per_unit' => 'float',
        'total_tax' => 'float',
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'product_variant_id');
    }
}
