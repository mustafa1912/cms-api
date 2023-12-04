<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Stocking;
use App\Models\StockingTable;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class StockingController extends Controller
{
    use GeneralTrait;

    public function show()
    {
        $Stocking = Stocking::where('softDelete',0)->get();
        return response()->json($Stocking);
    }

    public function store(Request $request)
    {


        try {
            $store_arr = [];
            foreach ($request->all() as $key => $value) {
                if ($key == '_token') continue;//skip token
                $store_arr[$key] = $value;
            }


            $Stocking = Stocking::create([
                'store_id' => $request->store_id,
                'date' => $request->date,
                'note' => $request->note,
            ]);


            foreach ($request->arrayStocking as $key=> $data) {
                StockingTable::create([
                    'Stocking_id'=>$Stocking->id,
                    'item_id'=>$data['item_id'],
                    'amount'=>$data['amount'],
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

            $Stocking = StockingTable::where('Stocking_id', $id)->select(['item_id','amount'])->get();


            return  $Stocking;


        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }

    }

    public function update(Request $request, $id)
    {
        $Stocking = Stocking::find($id);

        if (!$Stocking) {
            return $this->returnError('001', 'هذا  غير موجد');
        }
        try {
            $store_arr = [];
            foreach ($request->all() as $key => $value) {
                if ($key == '_token') continue;//skip token
                $store_arr[$key] = $value;
            }



            $Stocking=Stocking::where('id', $id)->update([
                'store_id' => $request->store_id,
                'date' => $request->date,
                'note' => $request->note,
            ]);


            StockingTable::where( 'Stocking_id',$id)->delete();


            foreach ($request->arrayStocking as $key=> $data) {
                StockingTable::create([
                    'Stocking_id'=>$id,
                    'item_id'=>$data['item_id'],
                    'amount'=>$data['amount'],
                ]);
            }
            return $this->returnSuccessMessage('update success', $Stocking);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }

    }

    public
    function delete($id)
    {
        Stocking::where('id', $id)->update([
            'softDelete'=>1,
        ]);
        StockingTable::where('Stocking_id',$id)->update([
            'softDelete'=>1,
        ]);

        return $this->returnSuccessMessage('deleting success', 'delete');          //return token

    }



}
