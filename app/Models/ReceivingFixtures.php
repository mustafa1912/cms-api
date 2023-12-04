<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceivingFixtures extends Model
{
    use HasFactory;
    protected $fillable = [


        'date',// التاريخ
        'compositionNumber',// رقم التركيبه
        'accept',// تم الاستلام
        'recipient',//المستلم
        'user_id',// اليوزر
        'note',// ملاحظات
        'softDelete',

    ];
}

