<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $table = 'product_variants';
    protected $guarded = [];

    public function model()
    {
        return $this->belongsTo(ProductModel::class);
    }

    public function line()
    {
        return $this->hasOne(CartLine::class);
    }
}
