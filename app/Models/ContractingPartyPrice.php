<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractingPartyPrice extends Model
{
    use HasFactory;
    protected $fillable = [
        'contractingParty_id',//اسم الجهه
        'note',//ملاحظات
        'softDelete',

    ];

}
