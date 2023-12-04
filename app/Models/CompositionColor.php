<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompositionColor extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',//الاسم
        'note',//ملاحظات
        'softDelete',

    ];
}
