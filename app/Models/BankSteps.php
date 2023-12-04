<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankSteps extends Model
{
    use HasFactory;
    protected $fillable = [
        'kind',
        'kind_id',
        'bank_id',
        'collection',
        'pay',
        'user_id',
        'patient_id',
        'supplier_id',
        'account_id',
        'contractingParty_id',
        'lab_id',
        'note',
        'softDelete',

    ];

    // kind
    //1-- استقبال مريض
    //2-- تحول من بنك لاخر

}
