<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class m_services extends Model
{public $timestamps = false;
    use HasFactory;
    protected $fillable = [
        'id',
        'service_code',
        'service_name',
        'service_tariff',
        'service_description'
    ];
}
