<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Str;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $guarded = [];

    protected function path(): Attribute
    {
        return Attribute::make(
            set: fn ($path) => implode('.', array_map(fn ($value) => Str::slug($value, '_'), explode('.', $path)))
        );
    }

    public function model()
    {
        return $this->belongsTo(ProductModel::class, 'code', 'code');
    }

    public function scopeGetCategoryChilds(Builder $query, $path, $level = 1)
    {
        $query->whereRaw("'$path' @> path AND nlevel(path) = nlevel('$path') + $level")
            ->where('node_type', 'category');
    }

    public function scopeFilterModels(Builder $query, $path, $orderBy = null, $sort = 'asc')
    {
        $sort = $sort == 'asc' || $sort == 'desc' ? $sort : 'asc';

        $query->whereRaw("'$path' @> path")
            ->where('node_type', 'model');

        if ($orderBy) {
            $query->join('product_models as pm', 'pm.code', '=', 'categories.code', 'inner');

            if ($orderBy == 'name') {
                $query->orderBy('pm.' . $orderBy, $sort);
            } elseif ($orderBy == 'price') {
                $query->selectRaw('pm.*, LEAST(MIN(r.price), MIN(r.discount_price)) as lower_price')
                    ->join('product_variants as pv', 'pv.product_model_id', '=', 'pm.id', 'inner')
                    ->join('rates as r', 'r.product_variant_id', '=', 'pv.id', 'inner')
                    ->groupBy('pm.id')
                    ->orderBy('lower_price', $sort);
            }
        }

        $query->with('model', function ($query) {
            $query->with('variants', function ($query) {
                $query->with(['stock', 'rate'])->active();
            })->active();
        });
    }

    public function scopeActive(Builder $query)
    {
        $query->where('active', true);
    }
}
