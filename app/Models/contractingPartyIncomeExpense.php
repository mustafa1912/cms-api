<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contractingPartyIncomeExpense extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'payingKind',
        'payingKind_id',
        'contractingParty_id',
        'user_id',
        'collection',
        'pay',
        'note',
        'softDelete',
    ];
}
