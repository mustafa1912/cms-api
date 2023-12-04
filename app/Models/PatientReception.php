<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientReception extends Model
{
    use HasFactory;
  // protected $table = 'patient_receptions';

    protected $fillable = [

        'date',// التاريخ
        'time',// الوقت
        'patient_id',//اختيار المريض
        'clinic_id',// اختيار العياده
        'doctor_id',//اختيار الطبيب المعالج
        'contractingParty_id',//اختيار جهه التعاقد
        'payingKind',// نوع الدفع
        'payingKind_id',// خزينه او بنك
        'allServicePatient',// اجمالي خدمات المريض
        'totalBearingSide',// اجمالي تحمل الجهه
        'discountValue',// قيمه الخصم
        'discountPercentage',// نسبه الخصم
        'total',// اجمالي المطلوب من المريض
        'note',//ملاحظات
        'softDelete',
        'cancelNote',//سبب الالغاء
        'softDelete',
        'user_id',//المستخدم

    ];
    protected $hidden=['created_at','updated_at',];

}
