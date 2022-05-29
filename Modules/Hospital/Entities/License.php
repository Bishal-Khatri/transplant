<?php

namespace Modules\Hospital\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class License extends Model
{
    use HasFactory, softDeletes,LogsActivity;

    protected $fillable = [];

    public function getCreatedAtAttribute($value)
    {
        return date('d M Y', strtotime($value));
    }

    public function getIssueDateAttribute($value)
    {
        return date('d M Y', strtotime($value));
    }

    public function getExpiryDateAttribute($value)
    {
        return date('d M Y', strtotime($value));
    }

    public function licenseable()
    {
        return $this->morphTo();
    }
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logAll();
    }
}
