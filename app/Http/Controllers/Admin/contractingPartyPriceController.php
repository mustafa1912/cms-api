<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClinicService;
use App\Models\ContractingPartyPrice;
use App\Models\ContractingPartyPriceTables;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class contractingPartyPriceController extends Controller
{
    use GeneralTrait;

    public function show()
    {
        $ContractingPartyPrice = ContractingPartyPrice::where('softDelete',0)->get();
        return response()->json($ContractingPartyPrice);
    }

    public function store(Request $request)
    {


        try {
            $store_arr = [];
            foreach ($request->all() as $key => $value) {
                if ($key == '_token') continue;//skip token
                $store_arr[$key] = $value;
            }


            $ContractingPartyPrice = ContractingPartyPrice::create([
                'contractingParty_id' => $request->contractingParty_id,
                'note' => $request->note,
            ]);



            foreach ($request->arrayContractingPartyPrice as $key=> $data) {
                ContractingPartyPriceTables::create([
                    'contractingPartyPrice_id'=>$ContractingPartyPrice->id,
                    'service_id'=>$data['service_id'],
                    'servicePrice'=>$data['servicePrice'],
                    'patientPrice'=>$data['patientPrice'],
                    'patientPer'=>$data['patientPer'],
                    'sidePrice'=>$data['sidePrice'],
                    'sidePer'=>$data['sidePer'],
                ]);
            }
            return $this->returnSuccessMessage('save success', 'storing');          //return token

        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }


    }

    public function showTables($id)
    {
        try {

            $ContractingPartyPrice = ContractingPartyPriceTables::where('contractingPartyPrice_id', $id)->get();


            return response()->json([
                'status' => true,
                'msg' => $ContractingPartyPrice
            ]);

        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }

    }

    public function update(Request $request, $id)
    {
        $ContractingPartyPrice = ContractingPartyPrice::find($id);

        if (!$ContractingPartyPrice) {
            return $this->returnError('001', 'هذا  غير موجد');
        }
        try {
            $store_arr = [];
            foreach ($request->all() as $key => $value) {
                if ($key == '_token') continue;//skip token
                $store_arr[$key] = $value;
            }

//            if ($request->hasFile('logo')) {
//                $store_arr['logo'] = $request->logo->store('public/ContractingPartyPrice/logo');
//            }

            $ContractingPartyPrice=ContractingPartyPrice::where('id', $id)->update([
                'contractingParty_id' => $request->contractingParty_id,
                'note' => $request->note,
            ]);


            ContractingPartyPriceTables::where( 'contractingPartyPrice_id',$id)->delete();
            foreach ($request->arrayContractingPartyPrice as $key=> $data) {


                ContractingPartyPriceTables::updateOrCreate([
                    'contractingPartyPrice_id'=>$id,
                    'service_id'=>$data['service_id'] ],[
                    'servicePrice'=>$data['servicePrice'],
                    'patientPrice'=>$data['patientPrice'],
                    'patientPer'=>$data['patientPer'],
                    'sidePrice'=>$data['sidePrice'],
                    'sidePer'=>$data['sidePer'],


                ]);
            }
            return $this->returnSuccessMessage('update success', $ContractingPartyPrice);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }

    }

    public
    function delete($id)
    {
        ContractingPartyPrice::where('id', $id)->update([
            'softDelete'=>1,
        ]);
        ContractingPartyPriceTables::where('contractingPartyPrice_id',$id)->update([
            'softDelete'=>1,
        ]);

        return $this->returnSuccessMessage('deleting success', 'delete');          //return token

    }

    public
    function showPrice($id)
    {
       $data=   ContractingPartyPriceTables::where('contractingPartyPrice_id',$id)->get();
        return $data;

    }
    public function contractingPartiesForClinic($id){
        try {


            $ContractingPartyPrice = ContractingPartyPriceTables::where('contractingPartyPrice_id',$id)->get();


            return $ContractingPartyPrice;
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }

    }
}
