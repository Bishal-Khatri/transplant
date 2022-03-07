<?php

namespace Modules\Cart\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Grocery\Entities\Item;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\Cart\Database\factories\CartFactory::new();
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
