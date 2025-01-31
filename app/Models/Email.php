<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $table = 'emails';
    protected $guarded = [];
    protected $dateFormat = 'd/m/Y H:i';
}
