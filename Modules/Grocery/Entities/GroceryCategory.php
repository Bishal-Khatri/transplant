<?php

namespace Modules\Grocery\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GroceryCategory extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\Grocery\Database\factories\GroceryCategoryFactory::new();
    }

    public function child()
    {
        return $this->hasMany(GroceryCategory::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(GroceryCategory::class, 'parent_id');
    }
}
