<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorAccounts extends Model
{
    use HasFactory;
    protected $fillable = [

        'date',//التاريخ
        'receiptNumber',//رقم الايصال الدفتري
        'supplier_id',//اسم المورد
        'supplierBalance',//رصيد المورد
        'payingKind',// نوع الدفع
        'payingKind_id',//الخزينه او البنك
        'pricePaid',//المبلغ المدفوع
        'rest',//المتبقي
        'note',//ملاحظات
        'softDelete',
    ];
}
