<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',//الاسم
        'internationalCode',//الكود الدولي
        'egyptCode',//الكود المصري
        'storeCode',//كود المخزن
        'measuring_id',//المقاس
        'company_id',//الشركه
        'kind_id',//النوع
        'unit_id',//الوحده
        'buyPrice',// سعر الشراء
        'salePrice',//سعر البيع
        'MaximumDiscountRate',//اقصي نسبه خصم
        'maxSaleQuantity',//اقصي كميه بيع
        'MinimumQuantity',//الحد الادني للكميه
        'QuantityLimit',//الحد الاقصي للكميه
        'note',//ملاحظات
        'softDelete',

    ];
}
