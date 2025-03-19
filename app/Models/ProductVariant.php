<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    protected $table = 'product_variants';
    protected $guarded = [];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'images' => 'array',
        ];
    }

    public function model()
    {
        return $this->belongsTo(ProductModel::class);
    }

    public function line()
    {
        return $this->hasOne(CartLine::class);
    }

    public function stock()
    {
        return $this->hasOne(Stock::class);
    }

    public function rate()
    {
        return $this->hasOne(Rate::class);
    }

    public function lines()
    {
        return $this->hasMany(OrderLine::class);
    }

    public function scopeActive(Builder $query)
    {
        $query->where('active', true);
    }
}
