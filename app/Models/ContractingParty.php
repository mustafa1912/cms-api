<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractingParty extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',//الاسم
        'date',//التاريخ
        'from',//فتره من
        'to',//فتره الي
        'accountNumber',// رقم الحساب
        'costCenter',//مركز التكلفه
        'note',//ملاحظات
        'active',//مفعل او غير مفعل
        'softDelete',

    ];
}
