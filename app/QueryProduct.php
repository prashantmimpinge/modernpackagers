<?php

namespace FleetCart;

use Illuminate\Database\Eloquent\Model;

class QueryProduct extends Model
{
    protected $fillable = [
        'name',
        'description',
        'featured_image',
        'slug',
    ];
}