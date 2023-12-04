<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddStoreToUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'store_id',
        'user_id',
        'softDelete',
    ];
}
