<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',//الاسم
        'store_id',//المخزن id
        'accountNumber',//رقم الحساب
        'costCenter',//مركز التكلفه
        'storeAccountNumber',//رقم حساب المخزن
        'department',//نوع القسم
        'note',//ملاحظات
        'softDelete',

    ];
    public function services()
    {


        return $this->hasMany(ClinicService::class, 'clinic_id', 'id');
    }
}
