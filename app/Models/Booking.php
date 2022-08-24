<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'phone',
        'pick_up_location',
        'drop_off_location',
        'pick_up_date',
        'drop_off_date',
        'car_id',
        'status',
    ];
    protected $dates = [
        'pick_up_date',
        'drop_off_date',
    ];
    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
