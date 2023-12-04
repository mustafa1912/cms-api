<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\BankSteps;
use App\Models\DayBankBalance;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class BankController extends Controller
{

    use GeneralTrait;

    public function show()
    {
        $Bank = Bank::where('softDelete',0)->get();
        return response()->json($Bank);
    }

    public function store(Request $request)
    {
        try {
            $store_arr = [];
            foreach ($request->all() as $key => $value) {
                if ($key == '_token') continue;//skip token
                $store_arr[$key] = $value;
            }

            Bank ::create($store_arr);
            return $this->returnSuccessMessage('save success','storing');          //return token

        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }


    }

    public function update(Request $request, $id)
    {
        $Bank = Bank::find($id);

        if (!$Bank) {
            return $this->returnError('001', 'هذا  غير موجد');
        }
        try {
            $store_arr = [];
            foreach ($request->all() as $key => $value) {
                if ($key == '_token') continue;//skip token
                $store_arr[$key] = $value;
            }
            Bank ::where('id', $id)->update($store_arr);
            return $this->returnSuccessMessage('save success','updating');          //return token
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }

    }

    public
    function delete($id)
    {
        Bank::where('id', $id)->update([
            'softDelete'=>1,
        ]);
        return $this->returnSuccessMessage('deleting success','delete');          //return token

    }
    public  function steps(){
        $Bank = BankSteps::where('softDelete',0)->get();
        return response()->json($Bank);
    }
    public function days(){

        $days=DayBankBalance::get();
        return $days;
    }
}



