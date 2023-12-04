<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TreasuryToBank extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'FromTreasury_id',
        'toBank_id',
        'balance',
        'note',
        'softDelete',

    ];
}
