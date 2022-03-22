<?php

namespace Modules\Restaurant\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Cart\Entities\Cart;

class RestaurantMenu extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\Restaurant\Database\factories\RestaurantMenuFactory::new();
    }

    public function cart()
    {
        return $this->morphOne(Cart::class, 'cartable');
    }
}
