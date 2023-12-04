<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\AddStoreToUser;
use App\Http\Controllers\Controller;

class AddStoreToUserController extends Controller
{
    //
    public function show()
    {
        $data = AddStoreToUser::get();
        return $data;
    }

    public function store(Request $request)
    {
        AddStoreToUser::create([
            'store_id' => $request->store_id,
            'user_id' => $request->user_id,
        ]);
    }

    public function update(Request $request, $id)
    {
        $AddClinicToUser = AddStoreToUser::find($id);
        $AddClinicToUser->update([
            'store_id' => $request->store_id,
            'user_id' => $request->user_id,
        ]);
    }

    public function delete($id)
    {
        AddStoreToUser::where('id', $id)->update([
            'softDelete' => 1,
        ]);
        return $this->returnSuccessMessage('deleting success', 'delete'); //return token
    }
}
