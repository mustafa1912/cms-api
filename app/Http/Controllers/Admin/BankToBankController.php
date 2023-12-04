<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\BankSteps;
use App\Models\BankToBank;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class BankToBankController extends Controller
{
    use GeneralTrait;

    public function show()
    {
        $BankToBank = BankToBank::where('softDelete',0)->get();
        return response()->json($BankToBank);
    }

    public function store(Request $request)
    {
        try {
            $store_arr = [];
            foreach ($request->all() as $key => $value) {
                if ($key == '_token') continue;//skip token
                $store_arr[$key] = $value;
            }

            BankToBank::create($store_arr);
            $bankFrom=Bank::where('id',$request->FromBank_id)->value('balance');
            $bankTo=Bank::where('id',$request->ToBank_id)->value('balance');
            if($bankFrom < $request->balance )
            {
                return $this->returnSuccessMessage('balance not Enough',$bankFrom);          //return token

            }
            Bank::where('id',$request->FromBank_id)->update([
                'balance'=>$bankFrom-$request->balance
            ]);
            Bank::where('id',$request->ToBank_id)->update([
                'balance'=>$bankTo+$request->balance
            ]);



            return $this->returnSuccessMessage('save success','storing');          //return token

        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }


    }

    public function update(Request $request, $id)
    {
        $BankToBank= BankToBank::find($id);

        if (!$BankToBank) {
            return $this->returnError('001', 'هذا  غير موجد');
        }
        try {
            $store_arr = [];
            foreach ($request->all() as $key => $value) {
                if ($key == '_token') continue;//skip token
                $store_arr[$key] = $value;
            }
            $lastBalance= BankToBank ::where('id', $id)->value('balance');
            Bank::where('id',$request->FromBank_id)->update([
                'balance'=>$lastBalance+$request->balance
            ]);
            Bank::where('id',$request->ToBank_id)->update([
                'balance'=>$lastBalance-$request->balance
            ]);
            $bankFrom=Bank::where('id',$request->FromBank_id)->value('balance');
            $bankTo=Bank::where('id',$request->ToBank_id)->value('balance');
            if($bankFrom < $request->balance )
            {
                return $this->returnSuccessMessage('balance not Enough',$bankFrom);          //return success message

            }
            Bank::where('id',$request->FromBank_id)->update([
                'balance'=>$bankFrom-$request->balance
            ]);
            Bank::where('id',$request->ToBank_id)->update([
                'balance'=>$bankTo+$request->balance
            ]);
            BankToBank ::where('id', $id)->update($store_arr);

            return $this->returnSuccessMessage('save success','updating');          ///return success message
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }

    }

    public
    function delete($id)
    {

        $lastBalance= BankToBank ::where('id', $id)->value('balance');
        $from=BankToBank ::where('id', $id)->value('FromBank_id');
        $to=BankToBank ::where('id', $id)->value('ToBank_id');
        $formBank=Bank::where('id',$from)->value('balance');
        $toBank=Bank::where('id',$to)->value('balance');
        Bank::where('id',$from)->update([
            'balance'=>$lastBalance+$formBank
        ]);
        Bank::where('id', $to)->update([
            'balance'=>$toBank-$lastBalance
        ]);
        BankToBank::where('id', $id)->update([
            'softDelete'=>1,
        ]);
        return $this->returnSuccessMessage('deleting success','delete');         //return success message

    }
}




