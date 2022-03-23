<?php

namespace Modules\Restaurant\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Amenity extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $casts = [
        'status' => 'boolean'
    ];

    protected static function newFactory()
    {
        return \Modules\Restaurant\Database\factories\AmenityFactory::new();
    }
}
