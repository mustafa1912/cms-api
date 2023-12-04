<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mortal extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',//التايخ
        'store_id',//المحزن
        'note',//ملاحظات
        'softDelete',

    ];
}
