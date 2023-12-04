<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchasesInvoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',//التاريخ
        'store_id',//اسم المخزن
        'payingKind',//نوع الدفع
        'supplier_id',//اسم المورد
        'supplierBalance',//رصيد المورد
        'payingKind_id',//الخزينه او البنك
        'delegateName',//اسم المندوب
        'notes',//ملاحظات
        'category_id',//اسم الصنف
        'unit',//الوحده
        'amount',//الكميه
        'unitPrice',//سعر الوحده
        'extraRatio',//نسبه لاضافه
        'discountPercentage',//نسبه  الخصم
        'totalPrice',// اجمالي السعر
        'softDelete',

    ];
}
