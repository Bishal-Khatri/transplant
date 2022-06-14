<?php

namespace Modules\ContentManagement\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
//    protected $table = 'tbl_links';

    public function getCreatedAtAttribute($value)
    {
        return date('M d Y', strtotime($value));
    }

    public function child()
    {
        return $this->hasMany(Menu::class, 'parent_id');
    }
}
