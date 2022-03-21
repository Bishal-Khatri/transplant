<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Grocery\Entities\Item;

class Category extends Model
{
    use HasFactory, softDeletes;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\Grocery\Database\factories\GroceryCategoryFactory::new();
    }

    public function child()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function items()
    {
        return $this->hasMany(Item::class, 'category_id');
    }
}
