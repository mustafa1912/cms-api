<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\AddBankToUser;
use App\Http\Controllers\Controller;

class AddBankToUserController extends Controller
{
    //
    public function show()
    {
        $data = AddBankToUser::get();
        return $data;
    }

    public function store(Request $request)
    {
        AddBankToUser::create([
            'bank_id' => $request->bank_id,
            'user_id' => $request->user_id,
        ]);
    }

    public function update(Request $request, $id)
    {
        $AddClinicToUser = AddBankToUser::find($id);
        $AddClinicToUser->update([
            'bank_id' => $request->bank_id,
            'user_id' => $request->user_id,
        ]);
    }

    public function delete($id)
    {
        AddBankToUser::where('id', $id)->update([
            'softDelete' => 1,
        ]);
        return $this->returnSuccessMessage('deleting success', 'delete'); //return token
    }
}
