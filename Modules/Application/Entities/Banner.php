<?php

namespace Modules\Application\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'image'];

    protected static function newFactory()
    {
        return \Modules\Application\Database\factories\BannerFactory::new();
    }
}
