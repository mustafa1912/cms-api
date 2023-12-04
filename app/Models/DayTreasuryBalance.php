<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DayTreasuryBalance extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'balance',
        'treasury_id',
    ];
}
