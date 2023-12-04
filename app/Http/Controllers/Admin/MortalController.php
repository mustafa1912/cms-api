<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mortal;
use App\Models\MortalTable;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class MortalController extends Controller
{
    use GeneralTrait;

    public function show()
    {
        $Mortal = Mortal::where('softDelete',0)->get();
        return response()->json($Mortal);
    }

    public function store(Request $request)
    {


        try {
            $store_arr = [];
            foreach ($request->all() as $key => $value) {
                if ($key == '_token') continue;//skip token
                $store_arr[$key] = $value;
            }


            $Mortal = Mortal::create([
                'store_id' => $request->store_id,
                'date' => $request->date,
                'note' => $request->note,
            ]);


            foreach ($request->arrayMortal as $key=> $data) {
                MortalTable::create([
                    'Mortal_id'=>$Mortal->id,
                    'item_id'=>$data['item_id'],
                    'amount'=>$data['amount'],
                ]);
            }
            return $this->returnSuccessMessage('save success', 'storing');

        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }


    }

    public function showTables($id)
    {
        try {

            $Mortal = MortalTable::where('Mortal_id', $id)->select(['item_id','amount'])->get();


            return  $Mortal;


        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }

    }

    public function update(Request $request, $id)
    {
        $Mortal = Mortal::find($id);

        if (!$Mortal) {
            return $this->returnError('001', 'هذا  غير موجد');
        }
        try {
            $store_arr = [];
            foreach ($request->all() as $key => $value) {
                if ($key == '_token') continue;//skip token
                $store_arr[$key] = $value;
            }



            $Mortal=Mortal::where('id', $id)->update([
                'store_id' => $request->store_id,
                'date' => $request->date,
                'note' => $request->note,
            ]);


            MortalTable::where( 'Mortal_id',$id)->delete();


            foreach ($request->arrayMortal as $key=> $data) {
                MortalTable::create([
                    'Mortal_id'=>$id,
                    'item_id'=>$data['item_id'],
                    'amount'=>$data['amount'],
                ]);
            }
            return $this->returnSuccessMessage('update success', $Mortal);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }

    }

    public
    function delete($id)
    {
        Mortal::where('id', $id)->update([
            'softDelete'=>1,
        ]);
        MortalTable::where('Mortal_id',$id)->update([
            'softDelete'=>1,
        ]);

        return $this->returnSuccessMessage('deleting success', 'delete');          //return token

    }



}
