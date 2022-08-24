<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionSuccess extends Model
{
    use HasFactory;
    protected $table = 'transaction_successes';

    protected $fillable = [
        'name',
        'phone',
        'transaction_started',
        'transaction_completed',
        'car_id'
    ];

    protected $dates = [
        'transaction_started',
        'transaction_completed',
    ];
}
