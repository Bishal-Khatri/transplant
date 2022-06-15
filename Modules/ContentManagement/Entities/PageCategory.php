<?php

namespace Modules\ContentManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PageCategory extends Model
{
    use HasFactory;

    protected $fillable = [];

    public function getCreatedAtAttribute($value)
    {
        return date('M d Y', strtotime($value));
    }

    public function child()
    {
        return $this->hasMany(PageCategory::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(PageCategory::class, 'parent_id');
    }

    public function pages()
    {
        return $this->hasMany(Page::class, 'category_id');
    }
}
