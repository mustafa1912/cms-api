<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',//الاسم
        'nameEn',//الاسم باتللغه الانجليزيه
        'mail',// الايميل
        'phone',// التليفون
        'whatsApp',//الوتس اب
        'address',//العنوان
        'softDelete',

    ];

}
