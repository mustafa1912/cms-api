<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class specialty extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',//الاسم
        'note',//التحصص
        'softDelete',

    ];
}
