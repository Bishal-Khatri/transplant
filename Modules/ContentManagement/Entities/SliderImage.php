<?php

namespace Modules\ContentManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SliderImage extends Model
{
    use HasFactory;
// REMOVE THIS FILE
    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\ContentManagement\Database\factories\SliderImageFactory::new();
    }

    public function slider(){
        return $this->belongsTo(Gallery::class, 'slider_id');
    }
}
