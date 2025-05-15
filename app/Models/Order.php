<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $guarded = [];

    protected $casts = [
        'total_price' => 'float',
        'tax_price' => 'float',
        'subtotal_price' => 'float',
        'shipping_price' => 'float',
        'shipping_tax' => 'float',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lines()
    {
        return $this->hasMany(OrderLine::class);
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }
}
