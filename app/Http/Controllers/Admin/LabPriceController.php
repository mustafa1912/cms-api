<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClinicServiceTable;
use App\Models\LabPrice;
use App\Models\LabPriceTable;
use Illuminate\Http\Request;
use App\Traits\GeneralTrait;

class LabPriceController extends Controller
{
    use GeneralTrait;

    public function show($id)
    {

        $companySitting = LabPrice::where('softDelete',0)->where('lab_id',$id)->select(['compositionType_id', 'composition_id','price'])->get();
        return response()->json($companySitting);
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
//                $store_arr['logo'] = $request->logo->store('public/companySitting/logo');
//            }


            foreach ($request->ArrayLabPrices as $key=> $data) {


                LabPrice::create([
                    'lab_id'=>$request->lab_id,
                      'compositionType_id'=>$data['compositionType_id'],
                    'composition_id'=>$data['composition_id'],
                    'price'=>$data['price'],
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

//            if ($request->hasFile('logo')) {
//                $store_arr['logo'] = $request->logo->store('public/companySitting/logo');
//            }


            LabPrice::where('lab_id',$id)->delete();
            foreach ($request->ArrayLabPrices as $key=> $data) {


                LabPrice::create([
                    'lab_id'=>$id,
                    'compositionType_id'=>$data['compositionType_id'] ,
                    'composition_id'=>$data['composition_id'],
                    'price'=>$data['price'],
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
        LabPrice::where('id', $id)->update([
            'softDelete'=>1,
        ]);
        return $this->returnSuccessMessage('deleting success','delete');          //return token

    }
    public
    function showAll($id)
    {

        $data= LabPrice::where('lab_id',$id)->get();
        return $data;

    }
}

