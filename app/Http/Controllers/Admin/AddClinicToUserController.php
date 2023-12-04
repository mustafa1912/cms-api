<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Clinic;
use Illuminate\Http\Request;
use App\Models\AddClinicToUser;
use App\Http\Controllers\Controller;

class AddClinicToUserController extends Controller
{

    public function show(){
        $data= AddClinicToUser::get();
        return $data;
    }

public function store(Request $request)
{
    AddClinicToUser::create([
        'clinic_id' => $request->clicnic_id,
        'user_id' => $request->user_id,
    ]);
}

public function update(Request $request, $id)
{
    $AddClinicToUser = AddClinicToUser::find($id);

    $AddClinicToUser->update([
        'clinic_id' => $request->clicnic_id,
        'user_id' => $request->user_id,
    ]);
}

public function delete($id)
    {
        AddClinicToUser::where('id', $id)->update([
            'softDelete'=>1,
        ]);
        return $this->returnSuccessMessage('deleting success','delete');          //return token
    }
}
