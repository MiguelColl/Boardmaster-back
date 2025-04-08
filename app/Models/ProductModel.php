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

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function category()
    {
        return $this->hasMany(Category::class, 'code', 'code');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function favorites()
    {
        return $this->belongsToMany(Favorite::class);
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

    public function scopeSearch(Builder $query, $search)
    {
        $query->where('name', 'ilike', "%$search%")
            ->orWhere('brand', 'ilike', "%$search%");
    }

    public function scopeLoadRelations(Builder $query)
    {
        $query->with([
            'variants' => function ($q) {
                $q->with(['stock', 'rate'])->active();
            },
            'comments'
        ]);
    }
}
