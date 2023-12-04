<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabPrice extends Model
{
    use HasFactory;
    protected $fillable = [

        'lab_id',// معمل id
        'compositionType_id',//نوع التركيبه id
        'composition_id',//التركيبه id
        'price',//السعر
        'softDelete',

    ];
}
