<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankToBank extends Model
{
    use HasFactory;
    protected $fillable = [

        'date',
        'FromBank_id',
        'toBank_id',
        'balance',
        'note',
        'softDelete',

    ];
}
