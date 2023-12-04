<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\AddTreasuryToUser;
use App\Http\Controllers\Controller;

class AddTreasuryToUserController extends Controller
{
    //
    public function show(){
        $data= AddTreasuryToUser::get();
        return $data;
    }

    public function store(Request $request)
    {
        AddTreasuryToUser::create([
            'treasury_id' => $request->treasury_id,
            'user_id' => $request->user_id,
        ]);
    }

    public function update(Request $request, $id)
    {
        $AddClinicToUser = AddTreasuryToUser::find($id);
        $AddClinicToUser->update([
            'treasury_id' => $request->treasury_id,
            'user_id' => $request->user_id,
        ]);
    }

    public function delete($id)
    {
        AddTreasuryToUser::where('id', $id)->update([
            'softDelete' => 1,
        ]);
        return $this->returnSuccessMessage('deleting success', 'delete'); //return token
    }
}
