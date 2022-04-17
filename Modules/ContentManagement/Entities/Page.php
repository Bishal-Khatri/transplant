<?php

namespace Modules\ContentManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use HasFactory, softDeletes;

    protected $fillable = [];
    protected $casts = [
        'title_visibility' => 'boolean',
        'visibility' => 'boolean',
    ];

    protected static function newFactory()
    {
        return \Modules\ContentManagement\Database\factories\PageFactory::new();
    }

    public function category(){
        return $this->belongsTo(PageCategory::class, 'category_id');
    }

    public function parent(){
        return $this->belongsTo(Page::class, 'parent_id');
    }

    public function child(){
        return $this->hasMany(Page::class, 'parent_id');
    }

    public function sections()
    {
        return $this->hasMany(PageSection::class, 'page_id')->orderBy('order', 'asc');
    }

}
