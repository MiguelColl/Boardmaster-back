<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use SoftDeletes;

    protected $table = 'carts';
    protected $guarded = [];

    protected $casts = [
        'taxes' => 'float',
        'shipment' => 'float',
        'discount' => 'float',
        'subtotal_price' => 'float',
        'total_price' => 'float',
    ];

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lines()
    {
        return $this->hasMany(CartLine::class);
    }

    public function scopeActive(Builder $q)
    {
        $q->where('active', true);
    }

    public function loadRelations()
    {
        return $this->load([
            'lines.variant.model',
            'coupon',
            'user',
        ]);
    }
}
