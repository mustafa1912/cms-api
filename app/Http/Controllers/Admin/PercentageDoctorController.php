<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PercentageDoctor;
use App\Models\PrecentageDoctorTable;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class PercentageDoctorController extends Controller
{
    use GeneralTrait;

    public function show()
    {
        $percentageDoctor=PercentageDoctor::where('softDelete',0)->get();
        return response()->json($percentageDoctor);
    }

    public function store(Request $request)
    {
        try {
            $store_arr = [];
            foreach ($request->all() as $key => $value) {
                if ($key == '_token') continue;//skip token
                $store_arr[$key] = $value;
            }


            $PercentageDoctor= PercentageDoctor ::create([
                'doctor_id'=>$request->doctor_id,
                'clinic_id'=>$request->clinic_id,
                'contractingParty_id'=>$request->contractingParty_id,
            ]);
            foreach ($request->arrayPercentageDoctor as $key=> $data) {

                PrecentageDoctorTable::create([
                    'percentageDoctor_id'=>$PercentageDoctor->id, //id
                    'service_id'=>$data['service_id'],
                    'price'=>$data['price'],
                    'percentage'=>$data['percentage'],

                ]);
            }
            return $this->returnSuccessMessage('save success','storing');          //return token

        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }


    }

    public function update(Request $request, $id)
    {
        $percentageDoctor=PercentageDoctor::find($id);

        if (!$percentageDoctor) {
            return $this->returnError('001', 'هذا  غير موجد');
        }
        try {
            $store_arr = [];
            foreach ($request->all() as $key => $value) {
                if ($key == '_token') continue;//skip token
                $store_arr[$key] = $value;
            }



            PercentageDoctor::where('id', $id)->update($store_arr);
            PercentageDoctor::where('id', $id)->update([
                'doctor_id'=>$request->doctor_id,
                'clinic_id'=>$request->clinic_id,
                'contractingParty_id'=>$request->contractingParty_id,
            ]);
            PrecentageDoctorTable::where('percentageDoctor_id',$id)->delete();
            foreach ($request->arrayPercentageDoctor as $key=> $data) {

                PrecentageDoctorTable::create([
                    'percentageDoctor_id'=>$id, //id
                    'service_id'=>$data['service_id'],
                    'price'=>$data['price'],
                    'percentage'=>$data['percentage'],

                ]);
            }
            return $this->returnSuccessMessage('save success','updating');          //return token
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }

    }

    public
    function delete($id)
    {PercentageDoctor::where('id', $id)->update([
        'softDelete'=>1,
    ]);
        return $this->returnSuccessMessage('deleting success','delete');          //return token

    }
}
