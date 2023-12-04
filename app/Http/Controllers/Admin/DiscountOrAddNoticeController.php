<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DiscountOrAddNotice;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class DiscountOrAddNoticeController extends Controller
{
    use GeneralTrait;

    public function show()
    {
        $DiscountOrAddNotice = DiscountOrAddNotice::where('softDelete',0)->get();
        return response()->json($DiscountOrAddNotice);
    }

    public function store(Request $request)
    {
        try {
            $store_arr = [];
            foreach ($request->all() as $key => $value) {
                if ($key == '_token') continue;//skip token
                $store_arr[$key] = $value;
            }
//            if ($request->hasFile('logo')) {
//                $store_arr['logo'] = $request->logo->store('public/DiscountOrAddNotice/logo');
//            }

            DiscountOrAddNotice ::create($store_arr);
            return $this->returnSuccessMessage('save success','storing');          //return token

        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }


    }

    public function update(Request $request, $id)
    {
        $DiscountOrAddNotice = DiscountOrAddNotice::find($id);

        if (!$DiscountOrAddNotice) {
            return $this->returnError('001', 'هذا  غير موجد');
        }
        try {
            $store_arr = [];
            foreach ($request->all() as $key => $value) {
                if ($key == '_token') continue;//skip token
                $store_arr[$key] = $value;
            }

//            if ($request->hasFile('logo')) {
//                $store_arr['logo'] = $request->logo->store('public/DiscountOrAddNotice/logo');
//            }

            DiscountOrAddNotice ::where('id', $id)->update($store_arr);
            return $this->returnSuccessMessage('save success','updating');          //return token
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }

    }

    public
    function delete($id)
    {
        DiscountOrAddNotice::where('id', $id)->update([
            'softDelete'=>1,
        ]);
        return $this->returnSuccessMessage('deleting success','delete');          //return token

    }
}



