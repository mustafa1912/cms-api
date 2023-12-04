<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{ use GeneralTrait;

    public function show()
    {
        $user = User::where('softDelete',0)->get();
        return response()->json($user);
    }

    public function store(Request $request)
    {
        try {
            $store_arr = [];
            foreach ($request->all() as $key => $value) {
                if ($key == '_token') continue;//skip token
                $store_arr[$key] = $value;
            }

            if ($request->has('password')) {
                    $store_arr['password'] = Hash::make($request['password']);
            }
            if ($request->has('password2')) {
                    $store_arr['password2'] =$request->password2;
            }
            dd($request->hasFile('photo'));
            return  $request->photo;
            if ($request->hasFile('photo')) {
                $store_arr['photo'] = $request->photo->store('public/user/photo');
            }
            User ::create($store_arr);
            return $this->returnSuccessMessage('save success','storing');          //return token

        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }


    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return $this->returnError('001', 'هذا  غير موجد');
        }
        try {
            $update_arr = [];
            foreach ($request->all() as $key => $value) {
                if ($key == '_token') continue;//skip token
                $update_arr[$key] = $value;
            }
            if ($request->has('password')) {
                $update_arr['password'] = Hash::make($request['password']);
            }
            if ($request->has('password2')) {
                $store_arr['password2'] =$request->password2;
            }
            if ($request->hasFile('photo')) {
                $update_arr['photo'] = $request->photo->store('public/user/photo');
            }
            User ::where('id', $id)->update($update_arr);
            return $this->returnSuccessMessage('save success','updating');          //return token
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }

    }

    public
    function delete($id)
    {
        User::where('id', $id)->update([
            'softDelete'=>1,
        ]);
        return $this->returnSuccessMessage('deleting success','delete');          //return token

    }
}
