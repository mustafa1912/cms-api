<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddBankToUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'bank_id',
        'user_id',
        'softDelete',
    ];
}
