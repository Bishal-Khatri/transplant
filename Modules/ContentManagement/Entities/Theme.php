<?php

namespace Modules\ContentManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Theme extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'is_active'];

    public function getCreatedAtAttribute($value)
    {
        return date('M d Y', strtotime($value));
    }
}
