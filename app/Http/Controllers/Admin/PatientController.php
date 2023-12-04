<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    use GeneralTrait;

    public function show()
    {
        $Patient = Patient::where('softDelete',0)->get();
        return response()->json($Patient);
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
//                $store_arr['logo'] = $request->logo->store('public/Patient/logo');
//            }

            Patient ::create($store_arr);
            return $this->returnSuccessMessage('save success','storing');          //return token

        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }


    }

    public function update(Request $request, $id)
    {
        $Patient = Patient::find($id);

        if (!$Patient) {
            return $this->returnError('001', 'هذا  غير موجد');
        }
        try {
            $store_arr = [];
            foreach ($request->all() as $key => $value) {
                if ($key == '_token') continue;//skip token
                $store_arr[$key] = $value;
            }


            Patient ::where('id', $id)->update($store_arr);
            return $this->returnSuccessMessage('save success','updating');          //return token
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }

    }

    public
    function delete($id)
    {
        Patient::where('id', $id)->update([
            'softDelete'=>1,
        ]);
        return $this->returnSuccessMessage('deleting success','delete');          //return token

    }

    public function patientData($id){
        $student = Patient::findOrFail($id);
        return response()->json([
            'status' => true,
            'data' => $student,
        ]);
    }
}



