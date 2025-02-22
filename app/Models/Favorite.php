<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $table = 'favorites';
    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function variants()
    {
        return $this->belongsToMany(ProductVariant::class);
    }
}
