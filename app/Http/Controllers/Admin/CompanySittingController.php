<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanySitting;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class CompanySittingController extends Controller
{
    use GeneralTrait;

    public function show()
    {
        $companySitting = CompanySitting::where('softDelete',0)->get();
        return response()->json($companySitting);
    }

    public function store(Request $request)
    {
        try {
            $store_arr = [];
            foreach ($request->all() as $key => $value) {
                if ($key == '_token') continue;//skip token
                $store_arr[$key] = $value;
            }
            if ($request->hasFile('logo')) {
                $store_arr['logo'] = $request->logo->store('public/companySitting/logo');
            }

            CompanySitting::create($store_arr);
            return $this->returnSuccessMessage('save success', 'storing');          //return token

        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }


    }

    public function update(Request $request, $id)
    {

        $companySitting = CompanySitting::find($id);

        if (!$companySitting) {
            return $this->returnError('001', 'هذا  غير موجد');
        }
        try {
            $store_arr = [];
            foreach ($request->all() as $key => $value) {
                if ($key == '_token') continue;//skip token
                $update_arr[$key] = $value;
            }

            if ($request->hasFile('logo')) {
                $update_arr['logo'] = $request->logo->store('public/companySitting/logo');
            }

            CompanySitting::where('id', $id)->update($update_arr);
            return $this->returnSuccessMessage('save success', 'updating');          //return token
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }

    }

    public
    function delete($id)
    {
        CompanySitting::where('id', $id)->update([
            'softDelete'=>1,
        ]);
        return $this->returnSuccessMessage('deleting success', 'delete');          //return token

    }
}
