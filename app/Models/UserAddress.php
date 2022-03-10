<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;
protected $fillable = ['user_id', 'district_id', 'street_id', 'local_address'];

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    public function street()
    {
        return $this->belongsTo(Street::class, 'street_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
