<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stocking extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',//التاريخ
        'store_id',//المحزن
        'note',//ملاحظات
        'softDelete',

    ];
}
