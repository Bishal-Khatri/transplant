<?php

namespace Modules\Restaurant\Entities;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\Restaurant\Database\factories\AppointmentFactory::new();
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
