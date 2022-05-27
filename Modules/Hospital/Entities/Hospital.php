<?php

namespace Modules\Hospital\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Administrator\Entities\Province;
use Modules\Administrator\Entities\District;
use Modules\Administrator\Entities\Municipality;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Hospital extends Model
{
    use HasFactory,LogsActivity;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\ContentManagement\Database\factories\HospitalFactory::new();
    }

    public function getCreatedAtAttribute($value)
    {
        return date('d M Y', strtotime($value));
    }

    public function license()
    {
        return $this->morphMany(License::class, 'licenseable');
    }

    public function getLicense()
    {
        $licenses = $this->license()->get();
        return $licenses->last();
    }
    public function province()
    {
        return $this->belongsTo(Province::class);
    }
    public function district(){
        return $this->belongsTo(District::class);
    }
    public function municipality(){
        return $this->belongsTo(Municipality::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logAll();
    }
}
