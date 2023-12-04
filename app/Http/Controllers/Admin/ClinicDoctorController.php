<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClinicDoctor;
use App\Models\ClinicDoctorTables;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class ClinicDoctorController extends Controller
{
    use GeneralTrait;

    public function show($id)
    {
        $ClinicDoctor = ClinicDoctor::where('softDelete',0)->where('clinic_id', $id)->select(['doctor_id', 'per'])->get();
        return response()->json($ClinicDoctor);
    }

    public function store(Request $request)
    {
        try {
            $store_arr = [];
            foreach ($request->all() as $key => $value) {
                if ($key == '_token') continue;//skip token
                $store_arr[$key] = $value;
            }


            foreach ($request->arrayClinicDoctor as $key => $data) {


                ClinicDoctor::create([
                    'clinic_id' => $request->clinic_id,
                    'doctor_id' => $data['doctor_id'],
                    'per' => $data['per'],

                ]);
            }
            return $this->returnSuccessMessage('save success', 'storing');          //return token

        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }


    }

    public function update(Request $request, $id)
    {
        $ClinicDoctor = ClinicDoctor::find($id);

        if (!$ClinicDoctor) {
            return $this->returnError('001', 'هذا  غير موجد');
        }
        try {
            $store_arr = [];
            foreach ($request->all() as $key => $value) {
                if ($key == '_token') continue;//skip token
                $store_arr[$key] = $value;
            }

            ClinicDoctor::where('clinic_id', $id)->delete();

            foreach ($request->arrayClinicDoctor as $key => $data) {


                ClinicDoctor::create([
                    'clinic_id' => $request->clinic_id,
                    'doctor_id' => $data['doctor_id'],
                    'per' => $data['per'],

                ]);
            }
            return $this->returnSuccessMessage('update success', 'updating');          //return token
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }

    }

    public
    function delete($id)
    {
        ClinicDoctor::where('clinic_id', $id)->update([
            'softDelete'=>1,
        ]);
        return $this->returnSuccessMessage('deleting success', 'delete');          //return token

    }

    public
    function showAll($id)
    {

        $data = ClinicDoctor::where('clinic_id', $id)->get();
        return $data;

    }

    function onlyDoctor()
    {
        try {

            $data = ClinicDoctor::select(['clinic_id'])->groupBy('clinic_id')->get();
            return $data;
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }
    function onlyDoctorService()
    {
        try {

            $data = ClinicDoctor::select([ 'doctor_id'])->groupBy('doctor_id')->get();
            return $data;
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }
    }
}

