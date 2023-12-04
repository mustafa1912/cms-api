<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PercentageDoctor extends Model
{
    use HasFactory;
    protected $fillable = [
        'doctor_id',//الدكتور
        'clinic_id',//العياده
        'contractingParty_id',//الجهه
                             //arrayPercentageDoctor
        'softDelete',

    ];
}
