<?php

namespace Modules\Cart\Entities;

use App\Models\User;
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

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function subscriber()
    {
        return $this->belongsTo(User::class, 'user_id');
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
