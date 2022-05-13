<?php

namespace Modules\Administrator\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Municipality extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\Administrator\Database\factories\MunicipalityFactory::new();
    }
    public function district(){
        return $this->belongsTo(District::class);
    }
    public function getCreatedAtAttribute($value)
    {
        return date('M d Y', strtotime($value));
    }
}
