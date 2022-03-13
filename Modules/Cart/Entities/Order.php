<?php

namespace Modules\Cart\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\Cart\Database\factories\OrderFactory::new();
    }

    public function getCreatedAtAttribute($value)
    {
        // return date('M d Y', strtotime($this->attributes['created_at']));
        return date('M d Y', strtotime($value));
    }


    public function cart()
    {
        return $this->hasMany(Cart::class, 'order_id');
    }
}
