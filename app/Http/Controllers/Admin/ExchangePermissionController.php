<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExchangePermission;
use App\Models\ExchangePermissionTable;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class ExchangePermissionController extends Controller
{
    use GeneralTrait;

    public function show()
    {
        $ExchangePermission = ExchangePermission::where('softDelete',0)->get();
        return response()->json($ExchangePermission);
    }

    public function store(Request $request)
    {


        try {
            $store_arr = [];
            foreach ($request->all() as $key => $value) {
                if ($key == '_token') continue;//skip token
                $store_arr[$key] = $value;
            }


            $ExchangePermission = ExchangePermission::create([
                'store_id' => $request->store_id,
                'date' => $request->date,
                'note' => $request->note,
            ]);


            foreach ($request->arrayExchangePermission as $key=> $data) {
                ExchangePermissionTable::create([
                    'ExchangePermission_id'=>$ExchangePermission->id,
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

            $ExchangePermission = ExchangePermissionTable::where('ExchangePermission_id', $id)->select(['item_id','amount'])->get();


            return  $ExchangePermission;


        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }

    }

    public function update(Request $request, $id)
    {
        $ExchangePermission = ExchangePermission::find($id);

        if (!$ExchangePermission) {
            return $this->returnError('001', 'هذا  غير موجد');
        }
        try {
            $store_arr = [];
            foreach ($request->all() as $key => $value) {
                if ($key == '_token') continue;//skip token
                $store_arr[$key] = $value;
            }



            $ExchangePermission=ExchangePermission::where('id', $id)->update([
                'store_id' => $request->store_id,
                'date' => $request->date,
                'note' => $request->note,
            ]);


            ExchangePermissionTable::where( 'ExchangePermission_id',$id)->delete();


            foreach ($request->arrayExchangePermission as $key=> $data) {
                ExchangePermissionTable::create([
                    'ExchangePermission_id'=>$id,
                    'item_id'=>$data['item_id'],
                    'amount'=>$data['amount'],
                ]);
            }
            return $this->returnSuccessMessage('update success', $ExchangePermission);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }

    }

    public
    function delete($id)
    {
        ExchangePermission::where('id', $id)->update([
            'softDelete'=>1,
        ]);
        ExchangePermissionTable::where('ExchangePermission_id',$id)->update([
            'softDelete'=>1,
        ]);

        return $this->returnSuccessMessage('deleting success', 'delete');          //return token

    }



}
