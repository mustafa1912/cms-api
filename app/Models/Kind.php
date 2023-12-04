<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kind extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',//النوع
        'note',//ملاحظات
        'softDelete',

    ];
}