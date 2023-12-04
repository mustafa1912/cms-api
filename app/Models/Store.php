<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;
    protected $fillable = [

        'name',//الاسم
        'code',//الكود
        'keeper',//امين المخزن
        'phone',//رقم التليفون
        'address',//العنوان
        'note',//ملاحظات
        'softDelete',

    ];
}
