<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ReceivingFixtures;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class ReceivingFixturesController extends Controller
{
    use GeneralTrait;

    public function show()
    {
        $ReceivingFixtures = ReceivingFixtures::where('softDelete',0)->get();
        return response()->json($ReceivingFixtures);
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
//                $store_arr['logo'] = $request->logo->store('public/ReceivingFixtures/logo');
//            }
LabRequest::where('id',$request->user_id)->update([
    'active' =>1,
]);
            ReceivingFixtures ::create($store_arr);
            return $this->returnSuccessMessage('save success','storing');          //return token

        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }


    }

    public function update(Request $request, $id)
    {
//         $LabRequest = LabRequest::where('id',$id)->value('active');
// dd($LabRequest);
// exit();
        $ReceivingFixtures = ReceivingFixtures::find($id);

        if (!$ReceivingFixtures) {
            return $this->returnError('001', 'هذا  غير موجد');
        }
        try {
            $store_arr = [];
            foreach ($request->all() as $key => $value) {
                if ($key == '_token') continue;//skip token
                $store_arr[$key] = $value;
            }

//            if ($request->hasFile('logo')) {
//                $store_arr['logo'] = $request->logo->store('public/ReceivingFixtures/logo');
//            }


            ReceivingFixtures ::where('id', $id)->update($store_arr);
            return $this->returnSuccessMessage('save success','updating');          //return token
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }

    }

    public
    function delete($id)
    {
        ReceivingFixtures::where('id', $id)->update([
            'softDelete'=>1,
        ]);
        return $this->returnSuccessMessage('deleting success','delete');          //return token

    }
}



