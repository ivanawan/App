<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class t_bookings extends Model
{public $timestamps = false;
    use HasFactory;
    protected $fillable = [
        'id',
        'vessel_id',
        'booking_date',
        'customer_name'
    ];
}
