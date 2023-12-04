<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountOrAddNotice extends Model
{
    use HasFactory;
    protected $fillable = [

        'date',//التاريخ
        'logoType',//نوع الشعار
        'supplier_id',//اسم المورد
        'supplierBalance',//رصيد المورد
        'price',//المبلغ
        'note',//ملاحظات
        'softDelete',

    ];
}
