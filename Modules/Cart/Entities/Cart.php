<?php

namespace Modules\Cart\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Grocery\Entities\Item;
use Modules\Restaurant\Entities\RestaurantMenu;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'quantity', 'price'];


    protected static function newFactory()
    {
        return \Modules\Cart\Database\factories\CartFactory::new();
    }

    public function cartable()
    {
        return $this->morphTo();
    }

//    public function item()
//    {
//        return $this->morphOne(Item::class, 'cartable');
//    }
//
//    public function menuItem()
//    {
//        return $this->morphOne(RestaurantMenu::class, 'cartable');
//    }
}
