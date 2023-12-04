<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MortalTable extends Model
{
    use HasFactory;
    protected $fillable = [

        'Mortal_id',
        'item_id',//الصنف
        'amount',//الكميه
        'softDelete',

    ];
}
