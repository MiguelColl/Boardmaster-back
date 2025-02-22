<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    use HasFactory;

    protected $table = 'product_models';
    protected $guarded = [];

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function toElastic()
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'name' => $this->name,
            'brand' => $this->brand,
        ];
    }

    public function scopeFilterByNews(Builder $query)
    {
        $query->whereBetween('created_at', [
            Carbon::now()->subMonth()->startOfDay(),
            Carbon::now()->endOfDay()
        ]);
    }

    public function scopeActive(Builder $query)
    {
        $query->where('active', true);
    }
}
