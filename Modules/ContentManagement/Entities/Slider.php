<?php

namespace Modules\ContentManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Slider extends Model
{
    // REMOVE THIS FILE
    use HasFactory;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\ContentManagement\Database\factories\SliderFactory::new();
    }

    public function images(){
        return $this->hasMany(SliderImage::class, 'slider_id');
    }
}
