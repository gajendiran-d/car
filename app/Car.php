<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'user_id', 'brand', 'model', 'color', 'year', 'image', 'address', 'latitude', 'longitude', 'active_status'
    ];
}
