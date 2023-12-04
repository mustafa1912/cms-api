<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryOfTheStoreTable extends Model
{
    use HasFactory;
    protected $fillable = [
        'InventoryOfTheStore_id',
        'item_id',//الصنف
        'amount',//الكميه
        'buyingPrice',//سعر  البيع
        'sellingPrice',//سعر الشراء
        'balance',//الرصيد
        'total',//الاجمالي
        'softDelete',

    ];
}
