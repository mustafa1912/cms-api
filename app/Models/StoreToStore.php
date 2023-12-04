<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreToStore extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',//التاريخ
        'FromStore_id',// امن المحزن
        'ToStore_id',//الي المحزن
        'note',//ملاحظات
        'softDelete',

    ];
}
