<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use SoftDeletes;

    protected $table = 'coupons';
    protected $guarded = [];

    protected $casts = [
        'ammount' => 'float',
    ];

    protected function code(): Attribute
    {
        return Attribute::make(
            set: function ($value) {
                return strtoupper($value);
            }
        );
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function scopeActive(Builder $q)
    {
        $q->where([
            'active' => true,
            'used' => false,
        ]);
    }

    public function scopeOnValidDate(Builder $q)
    {
        $today = Carbon::now()->startOfDay();

        $q->where('init_at', '<=', $today);
        $q->where(function ($q) use ($today) {
            return $q->where('finish_at', '>=', $today)
                ->orWhereNull('finish_at');
        });
    }
}
