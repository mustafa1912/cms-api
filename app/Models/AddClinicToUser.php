<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddClinicToUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'clinic_id',
        'user_id',
        'softDelete',
    ];
}
