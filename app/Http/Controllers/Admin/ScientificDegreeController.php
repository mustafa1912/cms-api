<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ScientificDegree;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class ScientificDegreeController extends Controller
{

    use GeneralTrait;

    public function show()
    {
        $ScientificDegree = ScientificDegree::where('softDelete',0)->get();
        return response()->json($ScientificDegree);
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
//                $store_arr['logo'] = $request->logo->store('public/ScientificDegree/logo');
//            }

            ScientificDegree ::create($store_arr);
            return $this->returnSuccessMessage('save success','storing');          //return token

        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }


    }

    public function update(Request $request, $id)
    {
        $ScientificDegree = ScientificDegree::find($id);

        if (!$ScientificDegree) {
            return $this->returnError('001', 'هذا  غير موجد');
        }
        try {
            $store_arr = [];
            foreach ($request->all() as $key => $value) {
                if ($key == '_token') continue;//skip token
                $store_arr[$key] = $value;
            }

//            if ($request->hasFile('logo')) {
//                $store_arr['logo'] = $request->logo->store('public/ScientificDegree/logo');
//            }

            ScientificDegree ::where('id', $id)->update($store_arr);
            return $this->returnSuccessMessage('save success','updating');          //return token
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }

    }

    public
    function delete($id)
    {
        ScientificDegree::where('id', $id)->update([
            'softDelete'=>1,
        ]);
        return $this->returnSuccessMessage('deleting success','delete');          //return token

    }
}

