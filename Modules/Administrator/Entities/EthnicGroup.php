<?php

namespace Modules\Administrator\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EthnicGroup extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\Administrator\Database\factories\EthnicGroupFactory::new();
    }
    public function getCreatedAtAttribute($value)
    {
        return date('M d Y', strtotime($value));
    }
}
