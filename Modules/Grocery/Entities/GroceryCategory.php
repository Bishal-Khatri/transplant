<?php

namespace Modules\Grocery\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class GroceryCategory extends Model
{
    use HasFactory, softDeletes;

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

    public function items()
    {
        return $this->hasMany(Item::class, 'category_id');
    }
}
