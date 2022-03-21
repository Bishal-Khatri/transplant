<?php

namespace Modules\Restaurant\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $casts = [
        'status' => 'boolean'
    ];

    protected static function newFactory()
    {
        return \Modules\Restaurant\Database\factories\RestaurantFactory::new();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function menu()
    {
        return $this->hasMany(RestaurantMenu::class, 'restaurant_id');
    }
}
