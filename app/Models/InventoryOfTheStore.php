<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryOfTheStore extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',//التاريح
        'store_id',//المخزن
        'note',//ملاحظات
        'softDelete',

    ];
}
