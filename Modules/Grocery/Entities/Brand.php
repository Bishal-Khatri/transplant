<?php

namespace Modules\Grocery\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected static function newFactory()
    {
        return \Modules\Grocery\Database\factories\GroceryBrandFactory::new();
    }
    public function getCreatedAtAttribute($value)
    {
        // return date('M d Y', strtotime($this->attributes['created_at']));
        return date('M-d-Y', strtotime($value));
    }
}
