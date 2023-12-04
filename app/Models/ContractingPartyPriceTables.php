<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractingPartyPriceTables extends Model
{
    use HasFactory;
    protected $fillable = [
        'contractingPartyPrice_id',
        'service_id',//idالخدمه -->data[service_id][]
        'servicePrice',//data[servicePrice][] سعر الخدمه
        'patientPrice',// data[patientPrice][] سعر المريض
        'patientPer',// data[patientPer][] //نسبه المريض
        'sidePrice', // data[sidePrice][] سعر الجهه
        'sidePer',//data[sidePer][] نسبه الجهه
        'softDelete',

    ];
}
