<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    protected $table = 'rates';
    protected $guarded = [];

    protected $casts = [
        'price' => 'float',
        'price_suggested' => 'float',
        'discount_price' => 'float',
    ];

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class);
    }
}
