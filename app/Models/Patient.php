<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $fillable = [

        'name1',//الاسم الاول
        'name2',//الاسم الثاني
        'name3',//الاسم الثالث
        'name4',//اللاسم الرابع
        'phone',//رقم الهاتف
        'whatsApp',//رقم الوتس
        'email',//الايميل
        'address',//العنوان
        'age',//العمر
        'gender',//النوع
        'balance',//المدينونيه
        'softDelete',

    ];
}
