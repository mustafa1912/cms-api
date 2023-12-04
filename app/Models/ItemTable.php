<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemTable extends Model
{
    use HasFactory;
    protected $fillable = [
        'item_id',//الصنف
        'store_id',//المحزن
        'balance',//الرصيد
        'softDelete',

    ];
}
