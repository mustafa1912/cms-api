<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InventoryOfTheStore;
use App\Models\InventoryOfTheStoreTable;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class InventoryOfTheStoreController extends Controller
{
    use GeneralTrait;

    public function show()
    {
        $InventoryOfTheStore = InventoryOfTheStore::where('softDelete',0)->get();
        return response()->json($InventoryOfTheStore);
    }

    public function store(Request $request)
    {


        try {
            $store_arr = [];
            foreach ($request->all() as $key => $value) {
                if ($key == '_token') continue;//skip token
                $store_arr[$key] = $value;
            }


            $InventoryOfTheStore = InventoryOfTheStore::create([
                'store_id' => $request->store_id,
                'date' => $request->date,
                'note' => $request->note,
            ]);


            foreach ($request->arrayInventoryOfTheStore as $key=> $data) {
                InventoryOfTheStoreTable::create([
                    'InventoryOfTheStore_id'=>$InventoryOfTheStore->id,
                    'item_id'=>$data['item_id'],
                    'amount'=>$data['amount'],
                    'buyingPrice'=>$data['buyingPrice'],
                    'sellingPrice'=>$data['sellingPrice'],
                    'balance'=>$data['balance'],
                    'total'=>$data['total'],
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

            $InventoryOfTheStore = InventoryOfTheStoreTable::where('InventoryOfTheStore_id', $id)
                ->select([
                    'item_id',
                    'amount',
                    'buyingPrice',
                    'sellingPrice',
                    'balance',
                    'total',
                ])
                ->get();


            return  $InventoryOfTheStore;


        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }

    }

    public function update(Request $request, $id)
    {
        $InventoryOfTheStore = InventoryOfTheStore::find($id);

        if (!$InventoryOfTheStore) {
            return $this->returnError('001', 'هذا  غير موجد');
        }
        try {
            $store_arr = [];
            foreach ($request->all() as $key => $value) {
                if ($key == '_token') continue;//skip token
                $store_arr[$key] = $value;
            }



            $InventoryOfTheStore=InventoryOfTheStore::where('id', $id)->update([
                'store_id' => $request->store_id,
                'date' => $request->date,
                'note' => $request->note,
            ]);


            InventoryOfTheStoreTable::where( 'InventoryOfTheStore_id',$id)->delete();


            foreach ($request->arrayInventoryOfTheStore as $key=> $data) {
                InventoryOfTheStoreTable::create([
                    'InventoryOfTheStore_id'=>$id,
                    'item_id'=>$data['item_id'],
                    'amount'=>$data['amount'],
                    'buyingPrice'=>$data['buyingPrice'],
                    'sellingPrice'=>$data['sellingPrice'],
                    'balance'=>$data['balance'],
                    'total'=>$data['total'],
                ]);
            }
            return $this->returnSuccessMessage('update success', $InventoryOfTheStore);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }

    }

    public
    function delete($id)
    {
        InventoryOfTheStore::where('id', $id)->update([
            'softDelete'=>1,
        ]);
        InventoryOfTheStoreTable::where('InventoryOfTheStore_id',$id)->update([
            'softDelete'=>1,
        ]);

        return $this->returnSuccessMessage('deleting success', 'delete');          //return token

    }



}
