<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TreasurySteps extends Model
{
    use HasFactory;
    protected $fillable = [
        'kind',
        'kind_id',
        'treasury_id',
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
}
