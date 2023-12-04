<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',//الاسم
        'nameEn',//الاسم باللغه الانجليزيه
        'nid',//الرقم القومي
        'membershipNo',// رقم العضويه
        'socialStatus',//الحاله الاجتماعيه
        'address',// العنوان
        'phone',// التليفون
        'whatsApp',// الوتس اب
        'mail',//الميل
        'specialization',// التخصص
        'department',// القسم
        'degree',//الدرجه العلميه
        'referralDoctor',//طبيب مساهم
        'contributing',//طبيب مساهم
        'accountNumber',//رقم الحساب
        'costCenter',//مركز التكلفه
        'softDelete',


    ];


}
