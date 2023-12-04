<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Treasury;
use App\Models\TreasuryToTreasury;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class TreasuryToTreasuryController extends Controller
{
    use GeneralTrait;

    public function show()
    {
        $TreasuryToTreasury = TreasuryToTreasury::where('softDelete',0)->get();
        return response()->json($TreasuryToTreasury);
    }

    public function store(Request $request)
    {
        try {
            $store_arr = [];
            foreach ($request->all() as $key => $value) {
                if ($key == '_token') continue;//skip token
                $store_arr[$key] = $value;
            }

            TreasuryToTreasury::create($store_arr);
            $bankFrom=Treasury::where('softDelete',0)->where('id',$request->FromTreasury_id)->value('balance');
            $bankTo=Treasury::where('softDelete',0)->where('id',$request->ToTreasury_id)->value('balance');
            if($bankFrom < $request->balance )
            {
                return $this->returnSuccessMessage('balance not Enough',$bankFrom);          //return token

            }
            Treasury::where('softDelete',0)->where('id',$request->FromTreasury_id)->update([
                'balance'=>$bankFrom-$request->balance
            ]);
            Treasury::where('softDelete',0)->where('id',$request->ToTreasury_id)->update([
                'balance'=>$bankTo+$request->balance
            ]);
            return $this->returnSuccessMessage('save success','storing');          //return token

        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }


    }

    public function update(Request $request, $id)
    {
        $TreasuryToTreasury= TreasuryToTreasury::where('softDelete',0)->find($id);

        if (!$TreasuryToTreasury) {
            return $this->returnError('001', 'هذا  غير موجد');
        }
        try {
            $store_arr = [];
            foreach ($request->all() as $key => $value) {
                if ($key == '_token') continue;//skip token
                $store_arr[$key] = $value;
            }
            $lastBalance= TreasuryToTreasury ::where('softDelete',0)->where('id', $id)->value('balance');
            Treasury::where('softDelete',0)->where('id',$request->FromTreasury_id)->update([
                'balance'=>$lastBalance+$request->balance
            ]);
            Treasury::where('softDelete',0)->where('id',$request->ToTreasury_id)->update([
                'balance'=>$lastBalance-$request->balance
            ]);
            $bankFrom=Treasury::where('id',$request->FromTreasury_id)->value('balance');
            $bankTo=Treasury::where('id',$request->ToTreasury_id)->value('balance');
            if($bankFrom < $request->balance )
            {
                return $this->returnSuccessMessage('balance not Enough',$bankFrom);          //return success message

            }
            Treasury::where('id',$request->FromTreasury_id)->update([
                'balance'=>$bankFrom-$request->balance
            ]);
            Treasury::where('id',$request->ToTreasury_id)->update([
                'balance'=>$bankTo+$request->balance
            ]);
            TreasuryToTreasury ::where('id', $id)->update($store_arr);

            return $this->returnSuccessMessage('save success','updating');          ///return success message
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }

    }

    public
    function delete($id)
    {

        $lastBalance= TreasuryToTreasury ::where('id', $id)->value('balance');
        $from=TreasuryToTreasury ::where('id', $id)->value('FromTreasury_id');
        $to=TreasuryToTreasury ::where('id', $id)->value('ToTreasury_id');
        $formTreasury=Treasury::where('id',$from)->value('balance');
        $toTreasury=Treasury::where('id',$to)->value('balance');
        Treasury::where('id',$from)->update([
            'balance'=>$lastBalance+$formTreasury
        ]);
        Treasury::where('id', $to)->update([
            'balance'=>$toTreasury-$lastBalance
        ]);
        TreasuryToTreasury::where('id', $id)->update([
            'softDelete'=>1,
        ]);
        return $this->returnSuccessMessage('deleting success','delete');         //return success message

    }
}




