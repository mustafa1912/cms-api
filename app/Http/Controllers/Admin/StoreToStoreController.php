<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StoreToStore;
use App\Models\StoreToStoreTable;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class StoreToStoreController extends Controller
{
    use GeneralTrait;

    public function show()
    {
        $StoreToStore = StoreToStore::where('softDelete',0)->get();
        return response()->json($StoreToStore);
    }

    public function store(Request $request)
    {


        try {
            $store_arr = [];
            foreach ($request->all() as $key => $value) {
                if ($key == '_token') continue;//skip token
                $store_arr[$key] = $value;
            }


            $StoreToStore = StoreToStore::create([
                'date'=>$request->date,
                'FromStore_id'=>$request->FromStore_id,
                'ToStore_id'=>$request->ToStore_id,
                'note'=>$request->note,
            ]);


            foreach ($request->arrayStoreToStore as $key=> $data) {
                StoreToStoreTable::create([
                    'StoreToStore_id'=>$StoreToStore->id,
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

            $StoreToStore = StoreToStoreTable::where('StoreToStore_id', $id)->select(['item_id','amount'])->get();


            return  $StoreToStore;


        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }

    }

    public function update(Request $request, $id)
    {
        $StoreToStore = StoreToStore::find($id);

        if (!$StoreToStore) {
            return $this->returnError('001', 'هذا  غير موجد');
        }
        try {
            $store_arr = [];
            foreach ($request->all() as $key => $value) {
                if ($key == '_token') continue;//skip token
                $store_arr[$key] = $value;
            }



            $StoreToStore=StoreToStore::where('id', $id)->update([
                'date'=>$request->date,
                'FromStore_id'=>$request->FromStore_id,
                'ToStore_id'=>$request->ToStore_id,
                'note'=>$request->note,
            ]);


            StoreToStoreTable::where( 'StoreToStore_id',$id)->delete();


            foreach ($request->arrayStoreToStore as $key=> $data) {
                StoreToStoreTable::create([
                    'StoreToStore_id'=>$id,
                    'item_id'=>$data['item_id'],
                    'amount'=>$data['amount'],
                ]);
            }
            return $this->returnSuccessMessage('update success', $StoreToStore);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }

    }

    public
    function delete($id)
    {
        StoreToStore::where('id', $id)->update([
            'softDelete'=>1,
        ]);
        StoreToStoreTable::where('StoreToStore_id',$id)->update([
            'softDelete'=>1,
        ]);

        return $this->returnSuccessMessage('deleting success', 'delete');          //return token

    }



}

