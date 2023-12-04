<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\ItemTable;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    use GeneralTrait;

    public function show()
    {
        $Item = Item::where('softDelete',0)->get();
        return response()->json($Item);
    }

    public function store(Request $request)
    {


        try {
            $store_arr = [];
            foreach ($request->all() as $key => $value) {
                if ($key == '_token') continue;//skip token
                $store_arr[$key] = $value;
            }


            $Item = Item::create([
                'name'=>$request->name,
                'internationalCode'=>$request->internationalCode,
                'egyptCode'=>$request->egyptCode,
                'storeCode'=>$request->storeCode,
                'measuring_id'=>$request->measuring_id,
                'company_id'=>$request->company_id,
                'kind_id'=>$request->kind_id,
                'unit_id'=>$request->unit_id,
                'buyPrice'=>$request->buyPrice,
                'salePrice'=>$request->salePrice,
                'MaximumDiscountRate'=>$request->MaximumDiscountRate,
                'maxSaleQuantity'=>$request->maxSaleQuantity,
                'MinimumQuantity'=>$request->MinimumQuantity,
                'QuantityLimit'=>$request->QuantityLimit,
                'note' => $request->note,
            ]);



            foreach ($request->arrayItem as $key=> $data) {
                ItemTable::create([
                    'item_id'=>$Item->id,
                    'store_id'=>$data['store_id'],
                    'balance'=>$data['balance'],
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

            $Item = ItemTable::where('item_id', $id)->select(['store_id','balance'])->get();


            return  $Item;


        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }

    }

    public function update(Request $request, $id)
    {
        $Item = Item::find($id);

        if (!$Item) {
            return $this->returnError('001', 'هذا  غير موجد');
        }
        try {
            $store_arr = [];
            foreach ($request->all() as $key => $value) {
                if ($key == '_token') continue;//skip token
                $store_arr[$key] = $value;
            }

//            if ($request->hasFile('logo')) {
//                $store_arr['logo'] = $request->logo->store('public/Item/logo');
//            }

            $Item=Item::where('id', $id)->update([
                'name'=>$request->name,
                'internationalCode'=>$request->internationalCode,
                'egyptCode'=>$request->egyptCode,
                'storeCode'=>$request->storeCode,
                'measuring_id'=>$request->measuring_id,
                'company_id'=>$request->company_id,
                'kind_id'=>$request->kind_id,
                'unit_id'=>$request->unit_id,
                'buyPrice'=>$request->buyPrice,
                'salePrice'=>$request->salePrice,
                'MaximumDiscountRate'=>$request->MaximumDiscountRate,
                'maxSaleQuantity'=>$request->maxSaleQuantity,
                'MinimumQuantity'=>$request->MinimumQuantity,
                'QuantityLimit'=>$request->QuantityLimit,
                'note' => $request->note,
            ]);


            ItemTable::where( 'item_id',$id)->delete();


                foreach ($request->arrayItem as $key=> $data) {
                    ItemTable::create([
                        'item_id'=>$Item->id,
                        'store_id'=>$data['store_id'],
                        'balance'=>$data['balance'],
                    ]);

            }
            return $this->returnSuccessMessage('update success', $Item);
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }

    }

    public
    function delete($id)
    {
        Item::where('id', $id)->update([
            'softDelete'=>1,
        ]);
        ItemTable::where('item_id',$id)->update([
            'softDelete'=>1,
        ]);

        return $this->returnSuccessMessage('deleting success', 'delete');          //return token

    }



}
