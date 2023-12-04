<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabRequest extends Model
{
    use HasFactory;
    protected $fillable = [


        'date',//التاريخ
        'patient_id',// اسم المريض
        'lab_id',//اسم المعمل
        'doctor_id',// الطبيب المعالج
        'kind',// النوع
        'color',// لون التركيبه
        'size',// المقاس
        'bite',// العضه
        'Code',// كود النه
        'compositionType',// نوع التركيبه
        'deliveryDate',// تاريخ لتسليم
        'delivery',//
        'active',
        'user_id',// اليوزر
        'note',// ملاحظات
        'softDelete',

    ];
}
