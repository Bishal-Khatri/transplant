<?php

namespace Modules\Grocery\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemQuantity extends Model
{
    use HasFactory;

    protected $casts = [
//        'purchase_date' => 'date'
    ];
    protected static function newFactory()
    {
        return \Modules\Grocery\Database\factories\GroceryQuantityFactory::new();
    }
    public function getCreatedAtAttribute($value)
    {
        // return date('M d Y', strtotime($this->attributes['created_at']));
        return date('M-d-Y', strtotime($value));
    }
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }
}
