<?php

namespace Modules\Hospital\Entities;

use Carbon\Carbon;
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
use Modules\Hospital\Enum\TransplantTypes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
class Patient extends Model
{
    use HasFactory,LogsActivity;

    protected $fillable = [];
    protected $appends = ['point'];
    protected $casts = [
        'dialysis_start_date' => 'date',
    ];
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

    // Patient Point Start
    public function getPointAttribute()
    {
        $pointByDialysis = 0;

        $pointByGender = $this->pointByGender();
        $pointByRegistration = $this->pointByRegistrationDate();

        if ($this->transplant_type === TransplantTypes::KIDNEY){
            $pointByDialysis = $this->pointByDialysis();
        }
        elseif($this->transplant_type === TransplantTypes::LIVER){
        }

        $totalPoint = (int) $pointByGender + (int) $pointByDialysis + $pointByRegistration;

        return $totalPoint;
    }

    private function pointByGender()
    {
        if($this->gender == 'male'){
            return 1;
        }
        elseif($this->gender == 'female'){
            return 2;
        }else{
            return 1;
        }
    }

    private function pointByRegistrationDate()
    {
        $registration_date = Carbon::parse($this->created_at);
        $today = Carbon::today();
        $number_of_months = $registration_date->diffInMonths($today);
        $score = $number_of_months / 6;
        return round($score, 2);
    }

    private function pointByDialysis()
    {
        $dialysis_start_date = $this->dialysis_start_date;
        if (!blank($dialysis_start_date)){

            $today = Carbon::today();
            $number_of_months = $dialysis_start_date->diffInMonths($today);
            $score = $number_of_months * 1;
            return $score;
        }
    }

    // Patient Points End

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
