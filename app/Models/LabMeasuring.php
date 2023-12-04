<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabMeasuring extends Model
{
    use HasFactory;
    protected $fillable = [

        'lab_id',//معمل  id
        'bitePrice',//سعر العضه
        'measuringPrice',//سعر المقاس
        'softDelete',

    ];
}
