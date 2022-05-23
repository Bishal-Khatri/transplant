<?php

namespace Modules\Hospital\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hospital extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\ContentManagement\Database\factories\HospitalFactory::new();
    }

    public function getCreatedAtAttribute($value)
    {
        return date('M d Y', strtotime($value));
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
}
