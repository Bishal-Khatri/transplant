<?php

namespace Modules\Administrator\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Administrator\Entities\District;

class Province extends Model
{
    use HasFactory;

    protected $fillable = [];

    public function getCreatedAtAttribute($value)
    {
        return date('M d Y', strtotime($value));
    }

    protected static function newFactory()
    {
        return \Modules\Administrator\Database\factories\ProvinceFactory::new();
    }

    public function districts(){
        return $this->hasMany(District::class);
    }
}
