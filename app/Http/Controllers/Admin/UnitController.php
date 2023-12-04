<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    use GeneralTrait;

    public function show()
    {
        $Unit = Unit::where('softDelete',0)->get();
        return response()->json($Unit);
    }

    public function store(Request $request)
    {
        try {
            $store_arr = [];
            foreach ($request->all() as $key => $value) {
                if ($key == '_token') continue;//skip token
                $store_arr[$key] = $value;
            }
//            if ($request->hasFile('logo')) {
//                $store_arr['logo'] = $request->logo->store('public/Unit/logo');
//            }

            Unit ::create($store_arr);
            return $this->returnSuccessMessage('save success','storing');          //return token

        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }


    }

    public function update(Request $request, $id)
    {
        $Unit = Unit::find($id);

        if (!$Unit) {
            return $this->returnError('001', 'هذا  غير موجد');
        }
        try {
            $store_arr = [];
            foreach ($request->all() as $key => $value) {
                if ($key == '_token') continue;//skip token
                $store_arr[$key] = $value;
            }

//            if ($request->hasFile('logo')) {
//                $store_arr['logo'] = $request->logo->store('public/Unit/logo');
//            }

            Unit ::where('id', $id)->update($store_arr);
            return $this->returnSuccessMessage('save success','updating');          //return token
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }

    }

    public
    function delete($id)
    {
        Unit::where('id', $id)->update([
            'softDelete'=>1,
        ]);
        return $this->returnSuccessMessage('deleting success','delete');          //return token

    }
}
