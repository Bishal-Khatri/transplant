<?php

namespace Modules\Cart\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class ImageOrder extends Model
{
    use HasFactory, softDeletes;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\Cart\Database\factories\ImageOrderFactory::new();
    }

    public function getCreatedAtAttribute($value)
    {
        return date('M d Y', strtotime($value));
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function orderBy()
    {
        return $this->belongsTo(User::class, 'order_by');
    }
}
