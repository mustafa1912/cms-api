<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabPriceTable extends Model
{
    use HasFactory;
    protected $fillable = [
        'lapPrice_id',
        'softDelete',

    ];
}
