<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanySitting extends Model
{

    use HasFactory;
    protected $fillable = [
        'name',//الاسم باللغه العربيه
        'nameEn',//الاسم باللغه الانجليزيه
        'address',//العنوان
        'phone',//رقم التليفون
        'phone2',//رقم تليفون ثان
        'whatsApp',//التوتس اب
        'fax',//الفاكس
        'website',//الويب سيت
        'youtube',//اليوتيوب
        'facebook',//الفيس بوك
        'commercialRegister',//السجل التجاري
        'taxCard',//البطاقه الضريبيه
        'tax',//نسبه الضريبه
        'logo',//اللوجو
        'softDelete',


    ];

}
