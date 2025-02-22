<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

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

    public function favorites()
    {
        return $this->belongsToMany(Favorite::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
