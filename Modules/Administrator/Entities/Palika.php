<?php

namespace Modules\Administrator\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Palika extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\Administrator\Database\factories\PalikaFactory::new();
    }
    public function district(){
        return $this->belongsTo(District::class);
    }
    public function getCreatedAtAttribute($value)
    {
        return date('M d Y', strtotime($value));
    }
}
