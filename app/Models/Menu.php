<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Str;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menus';
    protected $guarded = [];

    protected function path(): Attribute
    {
        return Attribute::make(
            set: fn ($path) => implode('.', array_map(fn ($value) => Str::slug($value, '_'), explode('.', $path)))
        );
    }

    public function scopeBase(Builder $query)
    {
        $query->whereRaw("nlevel(path) = 1");
    }

    public function scopeSubMenu(Builder $query, $path, $level = 1)
    {
        $query->whereRaw("'$path' @> path AND nlevel(path) = nlevel('$path') + $level")
            ->where('node_type', 'menu');
    }
}
