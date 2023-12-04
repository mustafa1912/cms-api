<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lab;
use App\Models\LabPrice;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use App\Traits\GeneralTrait;

class LabController extends Controller
{
    use GeneralTrait;

    public function show()
    {

        $lab = Lab::where('softDelete',0)->get();
        return $lab ;
    }

    public function store(Request $request)
    {
        try {
            Lab::create([
                'nameEn' => $request->nameEn,
                'name' => $request->name,
                'whatsApp' => $request->WhatsApp,
                'phone' => $request->phone,
                'mail' => $request->mail,
                'address' => $request->address,
            ]);
            return $this->returnSuccessMessage('save success','storing');          //return token

        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }


    }

    public function update(Request $request, $id)
    {

        try {
            Lab::where('id', $id)->update([
                'nameEn' => $request->nameEn,
                'name' => $request->name,
                'whatsApp' => $request->WhatsApp,
                'phone' => $request->phone,
                'mail' => $request->mail,
                'address' => $request->address,
            ]);
            return $this->returnSuccessMessage('save success','updating');          //return token
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }

    }

    public
    function delete($id)
    {
        Lab::where('id', $id)->update([
            'softDelete'=>1,
        ]);
        LabPrice::where('lab_id', $id)->update([
            'softDelete'=>1,
        ]);

        return $this->returnSuccessMessage('deleting success','delete');          //return token

    }
}
