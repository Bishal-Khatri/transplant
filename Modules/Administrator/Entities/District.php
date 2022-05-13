<?php

namespace Modules\Administrator\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class District extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\Administrator\Database\factories\DistrictFactory::new();
    }
    public  function province(){
        return $this->belongsTo(Province::class);
    }
    public function municipalities(){
        return $this->hasMany(Municipality::class);
    }
    public function palikas(){
        return $this->hasMany(Palika::class);
    }
    public function getCreatedAtAttribute($value)
    {
        return date('M d Y', strtotime($value));
    }
}
