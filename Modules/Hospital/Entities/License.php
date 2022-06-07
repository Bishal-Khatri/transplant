<?php

namespace Modules\Hospital\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class License extends Model
{
    use HasFactory, softDeletes,LogsActivity;

    protected $casts = [
        'expiry_date' => 'timestamp',
        'issue_date' => 'datetime'
    ];

    protected $fillable = [
        'license_number',
        'unique_key',
        'issued_by',
        'issue_date',
        'expiry_date',
    ];

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

    public function issuedByUser()
    {
        return $this->belongsTo(User::class, 'issued_by');
    }

    public function licenseable()
    {
        return $this->morphTo();
    }
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logAll();
    }

    public function licenseStatus()
    {
        $expiry_date = new \Carbon\Carbon($this->expiry_date);

        if ($expiry_date->isPast()){
            $data = [
                'status' => false,
                'message' => 'Expired',
                'expiry_diff' => $expiry_date->diffForHumans()
            ];
        }else{

            $data = [
                'status' => true,
                'message' => 'Active',
                'expiry_diff' => $expiry_date->diffForHumans()
            ];
        }

        return $data;
    }
}
