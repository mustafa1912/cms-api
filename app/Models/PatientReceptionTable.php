<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientReceptionTable extends Model
{
    use HasFactory;
 protected $table = 'patient_reception_tables';

    protected $fillable = [
        'patientReception_id',
        'service_id',//idالخدمه -->data[service_id][]
        'servicePrice',//data[servicePrice][] سعر الخدمه
        'patientPrice',// data[patientPrice][] سعر المريض
        'patientPer',// data[patientPer][] //نسبه المريض
        'sidePrice', // data[sidePrice][] سعر الجهه
        'sidePer',//data[sidePer][] نسبه الجهه
        'discount_amount',//قيمه الخصم
        'discount_per',//نسبه الخصم
                'softDelete',

    ];
    protected $hidden=['created_at','updated_at',];

}
