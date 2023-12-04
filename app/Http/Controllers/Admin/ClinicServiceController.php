<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Clinic;
use App\Models\ClinicService;
use App\Models\ClinicServiceTable;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class ClinicServiceController extends Controller
{
    use GeneralTrait;

    public function show($id)
    {
        $ClinicService = ClinicService::where('softDelete',0)->where('clinic_id',$id)->select(['classification_id','service_id'])->get();
        return response()->json($ClinicService);
    }

    public function store(Request $request)
    {
        try {
            $store_arr = [];
            foreach ($request->all() as $key => $value) {
                if ($key == '_token') continue;//skip token
                $store_arr[$key] = $value;
            }

            foreach ($request->ServiceToClinic as $key=> $data) {


                ClinicService::create([
                    'clinic_id'=>$request->clinic_id, //id
                    'classification_id'=>$data['classification_id'],
                    'service_id'=>$data['service_id'],

                ]);
            }
            return $this->returnSuccessMessage('save success','storing');          //return token

        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }


    }

    public function update(Request $request, $id)
    {

        try {
            $store_arr = [];
            foreach ($request->all() as $key => $value) {
                if ($key == '_token') continue;//skip token
                $store_arr[$key] = $value;
            }

            ClinicService::where('clinic_id', $id)->delete();
            foreach ($request->ServiceToClinic as $key=> $data) {


                ClinicService::create([
                    'clinic_id'=>$request->clinic_id,
                    'classification_id'=>$data['classification_id'] ,
                    'service_id'=>$data['service_id'],

                ]);
            }

            return $this->returnSuccessMessage('save success','updating');          //return token
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }

    }

    public
    function delete($id)
    {

        ClinicService::where('clinic_id', $id)->update([
            'softDelete'=>1,
        ]);
        return $this->returnSuccessMessage('deleting success','delete');          //return token

    }
    public
    function showAll($id)
    {

        $data= ClinicService::where('clinic_id',$id)->get();
        return $data;

    }
    function onlyClinic()
    {try {

        $data= ClinicService::select(['clinic_id'])->groupBy('clinic_id')->get();
        return $data;
    } catch (\Exception $ex) {
        return $this->returnError($ex->getCode(), $ex->getMessage());
    }
    }
    function onlyClinicService()
    {try {

        $data= ClinicService::select(['service_id'])->groupBy('service_id')->get();
        return $data;
    } catch (\Exception $ex) {
        return $this->returnError($ex->getCode(), $ex->getMessage());
    }
    }
}
