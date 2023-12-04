<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrecentageDoctorTable extends Model
{
    use HasFactory;
    protected $fillable = [
        'percentageDoctor_id',
        'percentage',//النسبه
        'price',//السعر
        'service_id',//الخدمه
        'softDelete',

    ];
}
