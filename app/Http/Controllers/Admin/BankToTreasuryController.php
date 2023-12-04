<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\BankToTreasury;
use App\Models\Treasury;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class BankToTreasuryController extends Controller
{
    use GeneralTrait;

    public function show()
    {
        $BankToTreasury = BankToTreasury::where('softDelete',0)->get();
        return response()->json($BankToTreasury);
    }

    public function store(Request $request)
    {
        try {
            $store_arr = [];
            foreach ($request->all() as $key => $value) {
                if ($key == '_token') continue;//skip token
                $store_arr[$key] = $value;
            }

            BankToTreasury::create($store_arr);
            $bankFrom=Bank::where('id',$request->FromBank_id)->value('balance');
            $TreasuryTo=Treasury::where('id',$request->ToTreasury_id)->value('balance');
            if($bankFrom < $request->balance )
            {
                return $this->returnSuccessMessage('balance not Enough',$bankFrom);          //return token

            }
            Bank::where('id',$request->FromBank_id)->update([
                'balance'=>$bankFrom-$request->balance
            ]);
            Treasury::where('id',$request->ToTreasury_id)->update([
                'balance'=>$TreasuryTo+$request->balance
            ]);
            return $this->returnSuccessMessage('save success','storing');          //return token

        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }


    }

    public function update(Request $request, $id)
    {
        $BankToTreasury= BankToTreasury::find($id);

        if (!$BankToTreasury) {
            return $this->returnError('001', 'هذا  غير موجد');
        }
        try {
            $store_arr = [];
            foreach ($request->all() as $key => $value) {
                if ($key == '_token') continue;//skip token
                $store_arr[$key] = $value;
            }
            $lastBalance= BankToTreasury ::where('id', $id)->value('balance');
            Bank::where('id',$request->FromBank_id)->update([
                'balance'=>$lastBalance+$request->balance
            ]);
            Treasury::where('id',$request->ToTreasury_id)->update([
                'balance'=>$lastBalance-$request->balance
            ]);
            $bankFrom=Bank::where('id',$request->FromBank_id)->value('balance');
            $TreasuryTo=Treasury::where('id',$request->ToTreasury_id)->value('balance');
            if($bankFrom < $request->balance )
            {
                return $this->returnSuccessMessage('balance not Enough',$bankFrom);          //return success message

            }
            Bank::where('id',$request->FromBank_id)->update([
                'balance'=>$bankFrom-$request->balance
            ]);
            Treasury::where('id',$request->ToTreasury_id)->update([
                'balance'=>$TreasuryTo+$request->balance
            ]);
            BankToTreasury ::where('id', $id)->update($store_arr);

            return $this->returnSuccessMessage('save success','updating');          ///return success message
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }

    }

    public
    function delete($id)
    {

        $lastBalance= BankToTreasury ::where('id', $id)->value('balance');
        $from=BankToTreasury ::where('id', $id)->value('FromBank_id');
        $to=BankToTreasury ::where('id', $id)->value('ToTreasury_id');
        $formBank=Bank::where('id',$from)->value('balance');
        $toTreasury=Treasury::where('id',$to)->value('balance');
        Bank::where('id',$from)->update([
            'balance'=>$lastBalance+$formBank
        ]);
        Treasury::where('id', $to)->update([
            'balance'=>$toTreasury-$lastBalance
        ]);
        BankToTreasury::where('id', $id)->update([
            'softDelete'=>1,
        ]);
        return $this->returnSuccessMessage('deleting success','delete');         //return success message

    }
}





