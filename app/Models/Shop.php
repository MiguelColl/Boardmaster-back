<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $table = 'shops';
    protected $guarded = [];

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }
}
