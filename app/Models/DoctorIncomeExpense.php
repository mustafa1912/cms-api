<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorIncomeExpense extends Model
{
    use HasFactory;
    protected $fillable = [
        //'kind',// نوع ايراد او مصروف 1 -> ايراد   2->مصروف
        'date',//التاريخ
        'payingKind',// نوع الدفع
        'payingKind_id',// id خزنه او بنك
        'doctor_id',// الدكتور
        'collection',
        'pay',
       // 'total',//المبلغ
        'user_id',//المستخدم
        'note',//ملاحظات
        'softDelete',
    ];
}
