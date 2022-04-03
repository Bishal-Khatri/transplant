<?php

namespace Modules\Cart\Entities;

use App\Enum\OrderPaymentStatus;
use App\Enum\OrderStatus;
use App\Models\User;
use App\Models\UserAddress;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $casts = [
        'status' => 'integer',
        'payment_status' => 'integer',
    ];

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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function address()
    {
        return $this->belongsTo(UserAddress::class, 'address_id');
    }

    public static function getStatus()
    {
        return collect([
            'SUCCESS' => OrderStatus::SUCCESS,
            'PROCESSING' => OrderStatus::PROCESSING,
            'SHIPPED' => OrderStatus::SHIPPED,
            'COMPLETED' => OrderStatus::COMPLETED,
            'CANCELED' => OrderStatus::CANCELED,
            'FAILED' => OrderStatus::FAILED,
        ]);
    }

    public static function paymentStatus()
    {
        return collect([
            'UNPAID' => OrderPaymentStatus::UNPAID,
            'SUCCESS' => OrderPaymentStatus::SUCCESS,
            'FAILED' => OrderPaymentStatus::FAILED,
        ]);
    }

    public function setUniqueId()
    {
        $this->unique_id = $this->user_id.$this->address_id.$this->id;
        return $this->save();
    }
}
