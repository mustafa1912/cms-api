<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExchangePermissionTable extends Model
{
    use HasFactory;
    protected $fillable = [
        'ExchangePermission_id',
        'item_id',//الصنف
        'amount',
        'softDelete',
//الكميه
    ];
}
