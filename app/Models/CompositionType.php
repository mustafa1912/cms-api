<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompositionType extends Model
{
    use HasFactory;
    protected $fillable = [

        'name',//الاسم
        'kind',// النوع
        'note',// ملاحظات
        'softDelete',

    ];
}
