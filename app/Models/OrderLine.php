<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderLine extends Model
{
    protected $table = 'order_lines';
    protected $guarded = [];

    protected $casts = [
        'price_unit' => 'float',
        'price_unit_base' => 'float',
        'price_total' => 'float',
        'price_total_base' => 'float',
        'original_price' => 'float',
        'tax_value' => 'float',
        'tax_unit' => 'float',
        'tax_total' => 'float',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class);
    }
}
