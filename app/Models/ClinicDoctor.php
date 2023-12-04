<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClinicDoctor extends Model
{
    use HasFactory;
    protected $fillable = [

        'clinic_id',//العياده id
        'doctor_id',
        'per',//النسبه
        'softDelete',

    ];
}
