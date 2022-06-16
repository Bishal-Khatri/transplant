<?php

namespace Modules\Hospital\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Administrator\Entities\Disease;
use Modules\Administrator\Entities\EducationLevel;
use Modules\Administrator\Entities\EthnicGroup;
use Modules\Administrator\Entities\Occupation;
use Modules\Administrator\Entities\Religion;
use Modules\Administrator\Entities\Province;
use Modules\Administrator\Entities\District;
use Modules\Administrator\Entities\Municipality;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
class Patient extends Model
{
    use HasFactory,LogsActivity;

    protected $fillable = [];
    protected static $logAttributes = [
        'name',
        'citizenship_number',
        'passport_number',
        'date_of_birth',
        'marital_status',
        'nationality',
        'contact_number_1',
        'contact_number_2',
        'email_address',
        'opd_number',
        'hospital_bipanna_number',
        'disease',
        'referred_by',
        'transplant_type',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logAll();
    }

    public function getCreatedAtAttribute($value)
    {
        return date('d M Y', strtotime($value));
    }

    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }

    // occupation
    public function occupation()
    {
        return $this->belongsTo(Occupation::class);
    }
    // education level
    public function education_level()
    {
        return $this->belongsTo(EducationLevel::class);
    }
    // religion
    public function religion()
    {
        return $this->belongsTo(Religion::class);
    }
    //ethnic group
    public function ethnic_group(){
        return $this->belongsTo(EthnicGroup::class);
    }

    // current province
    public function current_province(){
        return $this->belongsTo(Province::class);
    }
    // current district
    public function current_district(){
        return $this->belongsTo(District::class);
    }
    // current municipality
    public function current_municipality(){
        return $this->belongsTo(Municipality::class);
    }
    // permanent province
    public function permanent_province(){
        return $this->belongsTo(Province::class);
    }
    // permanent district
    public function permanent_district(){
        return $this->belongsTo(District::class);
    }
    // permanent municipality
    public function permanent_municipality(){
        return $this->belongsTo(Municipality::class);
    }

    public function disease(){
        return $this->belongsToMany(Disease::class);
    }

}
