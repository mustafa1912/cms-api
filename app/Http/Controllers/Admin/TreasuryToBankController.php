<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Treasury;
use App\Models\TreasuryToBank;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class TreasuryToBankController extends Controller
{
    use GeneralTrait;

    public function show()
    {
        $TreasuryToBank = TreasuryToBank::where('softDelete',0)->get();
        return response()->json($TreasuryToBank);
    }

    public function store(Request $request)
    {
        try {
            $store_arr = [];
            foreach ($request->all() as $key => $value) {
                if ($key == '_token') continue;//skip token
                $store_arr[$key] = $value;
            }

            TreasuryToBank::create($store_arr);
            $TreasuryFrom=Bank::where('id',$request->FromTreasury_id)->value('balance');
            $BankTo=Treasury::where('id',$request->ToBank_id)->value('balance');
            if($TreasuryFrom < $request->balance )
            {
                return $this->returnSuccessMessage('balance not Enough',$TreasuryFrom);          //return token

            }
            Treasury::where('id',$request->FromTreasury_id)->update([
                'balance'=>$TreasuryFrom-$request->balance
            ]);
            Bank::where('id',$request->ToBank_id)->update([
                'balance'=>$BankTo+$request->balance
            ]);
            return $this->returnSuccessMessage('save success','storing');          //return token

        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }


    }

    public function update(Request $request, $id)
    {
        $TreasuryToBank= TreasuryToBank::find($id);

        if (!$TreasuryToBank) {
            return $this->returnError('001', 'هذا  غير موجد');
        }
        try {
            $store_arr = [];
            foreach ($request->all() as $key => $value) {
                if ($key == '_token') continue;//skip token
                $store_arr[$key] = $value;
            }
            $lastBalance= TreasuryToBank ::where('id', $id)->value('balance');
            Treasury::where('id',$request->FromTreasury_id)->update([
                'balance'=>$lastBalance+$request->balance
            ]);
            Bank::where('id',$request->ToBank_id)->update([
                'balance'=>$lastBalance-$request->balance
            ]);
            $TreasuryFrom=Bank::where('id',$request->FromBank_id)->value('balance');
            $BankTo=Treasury::where('id',$request->ToTreasury_id)->value('balance');
            if($TreasuryFrom < $request->balance )
            {
                return $this->returnSuccessMessage('balance not Enough',$TreasuryFrom);          //return success message

            }
            Treasury::where('id',$request->FromTreasury_id)->update([
                'balance'=>$TreasuryFrom-$request->balance
            ]);
            Bank::where('id',$request->ToBank_id)->update([
                'balance'=>$BankTo+$request->balance
            ]);
            TreasuryToBank ::where('id', $id)->update($store_arr);

            return $this->returnSuccessMessage('save success','updating');          ///return success message
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }

    }

    public
    function delete($id)
    {

        $lastBalance= TreasuryToBank ::where('id', $id)->value('balance');
        $from=TreasuryToBank ::where('id', $id)->value('FromTreasury_id');
        $to=TreasuryToBank ::where('id', $id)->value('ToBank_id');
        $formTreasury=Treasury::where('id',$from)->value('balance');
        $toBank=Bank::where('id',$to)->value('balance');
        Treasury::where('id',$from)->update([
            'balance'=>$lastBalance+$formTreasury
        ]);
        Bank::where('id', $to)->update([
            'balance'=>$toBank-$lastBalance
        ]);
        TreasuryToBank::where('id', $id)->update([
            'softDelete'=>1,
        ]);
        return $this->returnSuccessMessage('deleting success','delete');         //return success message

    }
}





