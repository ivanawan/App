<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class m_vessels extends Model
{public $timestamps = false;
    use HasFactory;
    protected $fillable = [
        'id',
        'vessel_code',
        'vessel_name',
        'vessel_Description'
        
    ];
}
