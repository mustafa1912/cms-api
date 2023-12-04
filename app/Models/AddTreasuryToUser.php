<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddTreasuryToUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'treasury_id',
        'user_id',
        'softDelete',
    ];
}
