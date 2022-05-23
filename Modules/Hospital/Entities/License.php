<?php

namespace Modules\Hospital\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class License extends Model
{
    use HasFactory, softDeletes;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\Hospital\Database\factories\LicenseFactory::new();
    }

    public function getCreatedAtAttribute($value)
    {
        return date('M d Y', strtotime($value));
    }

    public function licenseable()
    {
        return $this->morphTo();
    }
}
