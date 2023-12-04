<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TheLost extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',//التاريخ
        'amount',//الكميه
        'unit',//الوحده
        'note',//ملاحظات
        'store_id',//اسم المخزن
        'category_id',//اسم الصنف
        'softDelete',

    ];
}
