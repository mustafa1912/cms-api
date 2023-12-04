<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreToStoreTable extends Model
{
    use HasFactory;
    protected $fillable = [
        'StoreToStore_id',
        'item_id',//الصنف
        'amount',//الكميه
        'softDelete',

    ];
}
