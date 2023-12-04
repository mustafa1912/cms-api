<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionAddCategory extends Model
{
    use HasFactory;
    protected $fillable = [

        'date',//التريخ
        'store_id',//اسم المخزن
        'category_id',//اسم الصنف
        'amount',//الكميه
        'note',//ملاحظات
        'softDelete',

    ];
}
