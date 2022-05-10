<?php

namespace Modules\ContentManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Theme extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'is_active'];

    protected static function newFactory()
    {
        return \Modules\ContentManagement\Database\factories\ThemeFactory::new();
    }
}
