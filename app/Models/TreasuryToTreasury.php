<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TreasuryToTreasury extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'FromTreasury_id',
        'toTreasury_id',
        'balance',
        'note',
        'softDelete',

    ];
}
