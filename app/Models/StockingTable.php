<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockingTable extends Model
{
    use HasFactory;
    protected $fillable = [
        'Stocking_id',
        'item_id',// الصنف
        'amount',//الكميه
        'softDelete',

    ];
}
