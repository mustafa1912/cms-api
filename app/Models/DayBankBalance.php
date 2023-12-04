<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DayBankBalance extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'balance',
        'bank_id',
    ];
}
