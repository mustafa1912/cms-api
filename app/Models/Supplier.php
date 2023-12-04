<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',// الاسم
        'code',//الكود
        'address',//العنوان
        'phone',//الهاتف
        'email',//الايميل
        'balance',//الرصيد
        'note',//ملاحظات
        'active',//تفعيل
        'softDelete',

    ];
}
