<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    protected $fillable = [
        'barcode',//الباركود
        'internationalCode',//الكود الدولي
        'egyptCode',//الكود المصري
        'name',//اسم الصنف
        'storeCode',//الكود المخزني
        'note',//ملاحظات
        'categoryNotes',//نقاط الصنف
        'profitableSellingPrice',// ربحيه اسعار البيع
        'sellingPrice',// سعر البيع
        'buyPrice',//سعر الشراء
        'maximumDiscountRate',//اقصي نسبه خصم
        'maximumSaleQuantity',//اقصي كميه بيع
        'MinimumQuantity',//الحد الادني للكميه
        'MaximumQuantity',// الحد الاقصي للكميه
        'price',//رصيد اول المده
        'company_id',// IDالشركه
        'store_id',//IDالمخزن
        'kind_id',//  IDالنوع
        'unit_id',// IDالوحده
        'measuring_id',//  ID المقاس
        'softDelete',

    ];
}
