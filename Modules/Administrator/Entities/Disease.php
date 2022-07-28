<?php

namespace Modules\Administrator\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Disease extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $casts = ['created_at' => 'date', 'updated_at' => 'date'];

    protected static function newFactory()
    {
        return \Modules\Administrator\Database\factories\DiseaseFactory::new();
    }

    public function getCreatedAtAttribute($value)
    {
        return date('M d Y', strtotime($value));
    }

    public function getUpdatedAtAttribute($value)
    {
        return date('M d Y', strtotime($value));
    }
}
