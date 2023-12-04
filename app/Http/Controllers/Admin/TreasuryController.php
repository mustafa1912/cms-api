<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DayTreasuryBalance;
use App\Models\Treasury;
use App\Models\TreasurySteps;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class TreasuryController extends Controller
{
    use GeneralTrait;

    public function show()
    {
        $Treasury = Treasury::where('softDelete',0)->get();
        return response()->json($Treasury);
    }

    public function store(Request $request)
    {
        try {
            $store_arr = [];
            foreach ($request->all() as $key => $value) {
                if ($key == '_token') continue;//skip token
                $store_arr[$key] = $value;
            }

            Treasury ::create($store_arr);
            return $this->returnSuccessMessage('save success','storing');          //return token

        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }


    }

    public function update(Request $request, $id)
    {
        $Treasury = Treasury::find($id);

        if (!$Treasury) {
            return $this->returnError('001', 'هذا  غير موجد');
        }
        try {
            $store_arr = [];
            foreach ($request->all() as $key => $value) {
                if ($key == '_token') continue;//skip token
                $store_arr[$key] = $value;
            }
            Treasury ::where('id', $id)->update($store_arr);
            return $this->returnSuccessMessage('save success','updating');          //return token
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }

    }

    public
    function delete($id)
    {
        Treasury::where('id', $id)->update([
            'softDelete'=>1,
        ]);
        return $this->returnSuccessMessage('deleting success','delete');          //return token

    }
    public  function steps(){
        $Treasury = TreasurySteps::where('softDelete',0)->get();
        return response()->json($Treasury);
    }
    public function days(){

        $days=DayTreasuryBalance::get();
        return $days;
    }
}



