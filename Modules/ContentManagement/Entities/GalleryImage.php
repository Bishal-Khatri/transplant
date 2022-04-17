<?php

namespace Modules\ContentManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GalleryImage extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\ContentManagement\Database\factories\GalleryImageFactory::new();
    }

    public function gallery(){
        return $this->belongsTo(Gallery::class, 'gallery_id');
    }
}
