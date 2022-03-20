<?php

namespace Modules\Grocery\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory, softDeletes;

    protected static function newFactory()
    {
        return \Modules\Grocery\Database\factories\GroceryItemFactory::new();
    }

    public function getCreatedAtAttribute($value)
    {
        // return date('M d Y', strtotime($this->attributes['created_at']));
        return date('M-d-Y', strtotime($value));
    }
    public function category()
    {
        return $this->belongsTo(GroceryCategory::class, 'category_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function quantityList()
    {
        return $this->hasMany(ItemQuantity::class, 'item_id')->orderBy('purchase_date', 'desc');
    }

    public function quantity()
    {
        return ItemQuantity::where('item_id', $this->id)->where('quantity', '!=', 0)->sum('quantity');
    }

//    public function stockLevel()
//    {
//        $quantity = ItemQuantity::where('item_id', $this->id)->where('quantity', '!=', 0)->sum('quantity');
//        if ($quantity < $this->min_quantity_threshold){
//            return 'LOW';
//        }
//        return 'OK';
//    }
    public function stockLevel()
    {
        $quantity_init = ItemQuantity::where('item_id', $this->id)->where('quantity', '!=', 0)->sum('initial_quantity');
        $quantity = ItemQuantity::where('item_id', $this->id)->where('quantity', '!=', 0)->sum('quantity');
        if ($quantity_init > 0){
            $per = $quantity/$quantity_init*100;
            $per = round($per);
        }else{
            $per = 0;
        }
        return $per;
    }

    public function itemMaxPrice()
    {
        return ItemQuantity::where('item_id', $this->id)->where('quantity', '!=', 0)->max('selling_price');
    }

    public function currentPrice()
    {
        $price = ItemQuantity::where('item_id', $this->id)->orderBy('id', 'desc')->first();
        return $price->selling_price ?? '';
    }

    /**
     * Gets item_quantity that have lowest stock and decreases quantity by 1
     * @param null $quantity
     * @return string
     */
    public function decreaseQuantity($quantity = null)
    {
        $itemQuantity = ItemQuantity::where('item_id', $this->id)->where('quantity', '<>', 0)->orderBy('quantity')->first();
        if ($itemQuantity){
            if ($quantity){
                $itemQuantity->quantity = (int)$itemQuantity->quantity - (int)$quantity;
                $itemQuantity->save();
            }else{
                $itemQuantity->decrement('quantity');
            }
        }
        return 'true';
    }

    /**
     * Gets item_quantity that have lowest stock and decreases quantity by 1
     * @param null $quantity
     * @return string
     */
    public function increaseQuantity($quantity = null)
    {
        $itemQuantity = ItemQuantity::where('item_id', $this->id)->orderBy('quantity', 'desc')->first();
        if ($itemQuantity){
            if ($quantity){
                $itemQuantity->quantity = (int)$itemQuantity->quantity + (int)$quantity;
                $itemQuantity->save();
            }else {
                $itemQuantity->increment('quantity');
            }
        }
        return 'true';
    }

    public function variants()
    {
        return $this->hasMany(Item::class, 'parent_id');
    }

    public function images()
    {
        return $this->hasMany(ItemImage::class, 'item_id');
    }

}
