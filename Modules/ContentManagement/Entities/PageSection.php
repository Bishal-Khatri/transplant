<?php

namespace Modules\ContentManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PageSection extends Model
{
    use HasFactory;

    protected $casts = [
        'background' => 'json',
        'json_data' => 'json'
    ];

    protected $fillable = [];

    public function getCreatedAtAttribute($value)
    {
        return date('M d Y', strtotime($value));
    }
}
