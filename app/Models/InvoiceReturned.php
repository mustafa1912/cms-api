<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceReturned extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',//التاريخ
        'numberOfInvoice',//رقم الفاتوره
        'dateOfInvoice',//تاريخ الفاتوره
        'supplier_id',//اسم المورد
        'store_id',//اسم المخزن
        'category_id',//اسم الصنف
        'unit',//الوحده
        'amount',//الكميه
        'unitPrice',//سعر الوحده
        'total',//الاجمالي
        'discountPercentage',//نسبه الخصم
        'discount',//قيمه الخصم
        'softDelete',

    ];
}
