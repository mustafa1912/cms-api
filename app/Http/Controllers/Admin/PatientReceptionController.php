<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\BankSteps;
use App\Models\DayBankBalance;
use App\Models\DaysBankBalance;
use App\Models\DayTreasuryBalance;
use App\Models\PatientReception;
use App\Models\PatientReceptionTable;
use App\Models\Treasury;
use App\Models\TreasurySteps;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class PatientReceptionController extends Controller
{
    use GeneralTrait;

    public function show()
    {
        $PatientReception = PatientReception::where('softDelete', 0)->get();
        return response()->json($PatientReception);
    }

    public function store(Request $request)
    {


        try {
            if ($request->payingKind == 1) {
                $balance = Treasury::where('id', $request->payingKind_id)->value('balance');

                Treasury::where('id', $request->payingKind_id)->update([
                    'balance' => $balance + $request->total,
                ]);
            } else {
                $balance = Bank::where('id', $request->payingKind_id)->value('balance');

                Bank::where('id', $request->payingKind_id)->update([
                    'balance' => $balance + $request->total,
                ]);
            }
            $patientReception_id = PatientReception::create([

                'date' => $request->date,
                'time' => $request->time,
                'patient_id' => $request->patient_id,
                'clinic_id' => $request->clinic_id,
                'doctor_id' => $request->doctor_id,
                'contractingParty_id' => $request->contractingParty_id,
                'payingKind' => $request->payingKind,
                'payingKind_id' => $request->payingKind_id,
                'allServicePatient' => $request->allServicePatient,
                'totalBearingSide' => $request->totalBearingSide,
                'discountValue' => $request->discountValue,
                'discountPercentage' => $request->discountPercentage,
                'total' => $request->total,
                'user_id' => $request->user_id,

                'note' => $request->note,
            ]);


            foreach ($request->ArrayPationReceptionsPrices as $key => $data) {

                PatientReceptionTable::create([
                    'patientReception_id' => $patientReception_id->id,
                    'service_id' => $data['service_id'],
                    'servicePrice' => $data['servicePrice'],
                    'patientPrice' => $data['patientPrice'],
                    'patientPer' => $data['patientPer'],
                    'sidePrice' => $data['sidePrice'],
                    'sidePer' => $data['sidePer'],
                    'discount_amount' => $data['discount_amount'],
                    'discount_per' => $data['discount_per'],

                ]);
            }


            if ($request->payingKind == 1) {
                DayTreasuryBalance::updateOrCreate([
                    'date' => date('d-m-Y'),
                    'treasury_id' => $request->payingKind], [
                    'balance' =>  $balance + $request->total,
                ]);

                TreasurySteps::create([
                    'kind' => 'استقبال مريض',
                    'kind_id' => $patientReception_id->id,
                    'treasury_id' => $request->payingKind_id,
                    // 'pay' => $total,                //مدين --خارج
                    'collection' => $request->total, // داين -- داخل
                    'user_id' => $request->user_id,
                    'patient_id' => $request->patient_id,
                    'note' => $request->note,
                ]);
            }
            else {
                DayBankBalance::updateOrCreate([
                    'date' => date('d-m-Y'),
                    'bank_id' => $request->payingKind], [
                    'balance' =>  $balance + $request->total,
                ]);
                BankSteps::create([
                    'kind' => 'استقبال مريض',
                    'kind_id' => $patientReception_id->id,
                    'bank_id' => $request->payingKind_id,
                    // 'pay' => $total,                //مدين --خارج
                    'collection' => $request->total, // داين -- داخل
                    'user_id' => $request->user_id,
                    'patient_id' => $request->patient_id,
                    'note' => $request->note,
                ]);
            }
            return $this->returnSuccessMessage('save success', 'storing');          //return token

        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }


    }

    public function update(Request $request, $id)
    {
        $PatientReception = PatientReception::find($id);

        if (!$PatientReception) {
            return $this->returnError('001', 'هذا  غير موجد');
        }
        try {
            $store_arr = [];
            foreach ($request->all() as $key => $value) {
                if ($key == '_token') continue;//skip token
                $store_arr[$key] = $value;
            }
            $total = PatientReception::where('id', $id)->value('total');
            if ($request->payingKind == 1) {
                $balance = Treasury::where('id', $request->payingKind_id)->value('balance');
                if ($balance < $total) {
                    return $this->returnSuccessMessage('balance not enough', '401');          //return token
                }
                Treasury::where('id', $request->payingKind_id)->update([
                    'balance' => $balance - $total,
                ]);
            } else {
                $balance = Bank::where('id', $request->payingKind_id)->value('balance');
                if ($balance < $total) {
                    return $this->returnSuccessMessage('balance not enough', '401');          //return token
                }
                Bank::where('id', $request->payingKind_id)->update([
                    'balance' => $balance - $total,
                ]);
            }
            PatientReception::where('id', $id)->update([

                'date' => $request->date,
                'time' => $request->time,
                'patient_id' => $request->patient_id,
                'clinic_id' => $request->clinic_id,
                'doctor_id' => $request->doctor_id,
                'contractingParty_id' => $request->contractingParty_id,
                'payingKind' => $request->payingKind,
                'payingKind_id' => $request->payingKind_id,
                'allServicePatient' => $request->allServicePatient,
                'totalBearingSide' => $request->totalBearingSide,
                'discountValue' => $request->discountValue,
                'discountPercentage' => $request->discountPercentage,
                'total' => $request->total,
                'user_id' => $request->user_id,
                'note' => $request->note,

            ]);

            PatientReceptionTable::where('patientReception_id', $id)->delete();
            foreach ($request->ArrayPationReceptionsPrices as $key => $data) {
                PatientReceptionTable::create([
                    'patientReception_id' => $id,
                    'service_id' => $data['service_id'],
                    'servicePrice' => $data['servicePrice'],
                    'patientPrice' => $data['patientPrice'],
                    'patientPer' => $data['patientPer'],
                    'sidePrice' => $data['sidePrice'],
                    'sidePer' => $data['sidePer'],
                    'discount_amount' => $data['discount_amount'],
                    'discount_per' => $data['discount_per'],

                ]);
            }
            if ($request->payingKind == 1) {
                DayTreasuryBalance::updateOrCreate([
                    'date' => date('d-m-Y'),
                    'treasury_id' => $request->payingKind], [
                    'balance' =>  $balance + $request->total,
                ]);

                TreasurySteps::where('kind', 1)->where('kind_id', $id)->update([
                    'treasury_id' => $request->payingKind_id,
                    'collection' => $request->total,
                    'pay' => Null,
                    'user_id' => $request->user_id,
                    'patient_id' => $request->patient_id,
                    'supplier_id' => Null,
                    'account_id' => Null,
                    'note' => $request->note,
                ]);
            }
            else {
                DayBankBalance::updateOrCreate([
                    'date' => date('d-m-Y'),
                    'bank_id' => $request->payingKind], [
                    'balance' =>  $balance + $request->total,
                ]);
                BankSteps::where('kind', 1)->where('kind_id', $id)->update([
                    'bank_id' => $request->payingKind_id,
                    'collection' => $request->total,
                    'pay' => Null,
                    'user_id' => $request->user_id,
                    'patient_id' => $request->patient_id,
                    'supplier_id' => Null,
                    'account_id' => Null,
                    'note' => $request->note,
                ]);
            }
            $total = PatientReception::where('id', $id)->value('total');

            if ($request->payingKind == 1) {
                $balance = Treasury::where('id', $request->payingKind_id)->value('balance');
                if ($request->total > $total) {
                    return $this->returnSuccessMessage('balance not enough', '401');          //return token
                }
                Treasury::where('id', $request->payingKind_id)->update([
                    'balance' => $balance + $request->total,
                ]);
            } else {
                $balance = Bank::where('id', $request->payingKind_id)->value('balance');
                if ($request->total > $total) {
                    return $this->returnSuccessMessage('balance not enough', '401');          //return token
                }
                Bank::where('id', $request->payingKind_id)->update([
                    'balance' => $balance + $request->total,
                ]);
            }
            return $this->returnSuccessMessage('update success', 'updating');          //return token
        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }

    }

    public
    function delete(Request $request ,$id)
    {
        $total = PatientReception::where('id', $id)->value('total');
        $payingKind = PatientReception::where('id', $id)->value('payingKind');
        $payingKind_id = PatientReception::where('id', $id)->value('payingKind_id');
        $patient_id = PatientReception::where('id', $id)->value('patient_id');
        $note = PatientReception::where('id', $id)->value('note');
        if ($payingKind == 1) {
            $balance = Treasury::where('id', $payingKind_id)->value('balance');
            if ($balance < $total) {
                return $this->returnSuccessMessage('balance not enough', '401');          //return token
            }
            Treasury::where('id', $payingKind_id)->update([
                'balance' => $balance - $total,
            ]);
            DayTreasuryBalance::updateOrCreate([
                'date' => date('d-m-Y'),
                'treasury_id' => $payingKind], [
                'balance' =>  $balance + $total,
            ]);
        } else {
            $balance = Bank::where('id', $payingKind_id)->value('balance');
            if ($balance < $total) {
                return $this->returnSuccessMessage('balance not enough', '401');          //return token
            }
            Bank::where('id', $payingKind_id)->update([
                'balance' => $balance - $total,
            ]);
            DayBankBalance::updateOrCreate([
                'date' => date('d-m-Y'),
                'bank_id' => $payingKind], [
                'balance' =>  $balance + $total,
            ]);
        }
        if ($payingKind == 1) {
            TreasurySteps::create([
                'kind' => 1,
                'kind_id' => $id,
                'treasury_id' => $payingKind_id,
                'collection' => Null,
                'pay' => $total,
                'user_id' => 1,
                'patient_id' => $patient_id,
                'supplier_id' => Null,
                'account_id' => Null,
                'note' => $note,
            ]);
        } else {
            BankSteps::create([
                'kind' => 1,
                'kind_id' => $id,
                'bank_id' => $payingKind_id,
                'collection' => Null,
                'pay' => $total,
                'user_id' => 1,
                'patient_id' => $patient_id,
                'supplier_id' => Null,
                'account_id' => Null,
                'note' => $note,
            ]);
        }
        PatientReception::where('id', $id)->update([
            'softDelete' => 1,
            'cancelNote'=>$request->cancelNote,
        ]);
        return $this->returnSuccessMessage('deleting success', 'delete');          //return token

    }

    public function reportFromTo(Request $request)

    {


        if ($request->to != 0 && $request->doctor_id != 0 && $request->clinic_id != 0 && $request->patient_id != 0) {


            $PatientReception = PatientReception::whereDate('date', '>=', $request->from)
                ->whereDate('date', '<=', $request->to)
                ->whereDate('doctor_id', $request->doctor_id)
                ->where('clinic_id', $request->clinic_id)
                ->where('patient_id', $request->patient_id)
                ->get();

        } elseif ($request->to != 0 && $request->doctor_id == 0 && $request->clinic_id == 0 && $request->patient_id == 0) {


            $PatientReception = PatientReception::whereDate('date', '>=', $request->from)
                ->whereDate('date', '<=', $request->to)
                //->whereDate('doctor_id',$request->doctor_id)
                // ->where('clinic_id',$request->clinic_id)
                // ->where('patient_id',$request->patient_id)
                ->get();

        } elseif ($request->to != 0 && $request->doctor_id == 0 && $request->clinic_id != 0 && $request->patient_id == 0) {


            $PatientReception = PatientReception::whereDate('date', '>=', $request->from)
                ->whereDate('date', '<=', $request->to)
                // ->whereDate('doctor_id',$request->doctor_id)
                ->where('clinic_id', $request->clinic_id)
                //->where('patient_id',$request->patient_id)
                ->get();

        } elseif ($request->to != 0 && $request->doctor_id == 0 && $request->clinic_id != 0 && $request->patient_id != 0) {


            $PatientReception = PatientReception::whereDate('date', '>=', $request->from)
                ->whereDate('date', '<=', $request->to)
                // ->whereDate('doctor_id',$request->doctor_id)
                ->where('clinic_id', $request->clinic_id)
                ->where('patient_id', $request->patient_id)
                ->get();

        } elseif ($request->to != 0 && $request->doctor_id == 0 && $request->clinic_id == 0 && $request->patient_id != 0) {


            $PatientReception = PatientReception::whereDate('date', '>=', $request->from)
                ->whereDate('date', '<=', $request->to)
                // ->whereDate('doctor_id',$request->doctor_id)
                //->where('clinic_id',$request->clinic_id)
                ->where('patient_id', $request->patient_id)
                ->get();

        } elseif ($request->to != 0 && $request->doctor_id != 0 && $request->clinic_id != 0 && $request->patient_id == 0) {


            $PatientReception = PatientReception::whereDate('date', '>=', $request->from)
                ->whereDate('date', '<=', $request->to)
                ->whereDate('doctor_id', $request->doctor_id)
                ->where('clinic_id', $request->clinic_id)
                // ->where('patient_id',$request->patient_id)
                ->get();

        } elseif ($request->to != 0 && $request->doctor_id != 0 && $request->clinic_id == 0 && $request->patient_id != 0) {


            $PatientReception = PatientReception::whereDate('date', '>=', $request->from)
                ->whereDate('date', '<=', $request->to)
                ->whereDate('doctor_id', $request->doctor_id)
                //->where('clinic_id',$request->clinic_id)
                ->where('patient_id', $request->patient_id)
                ->get();

        } elseif ($request->to != 0 && $request->doctor_id != 0 && $request->clinic_id == 0 && $request->patient_id == 0) {


            $PatientReception = PatientReception::whereDate('date', '>=', $request->from)
                ->whereDate('date', '<=', $request->to)
                ->whereDate('doctor_id', $request->doctor_id)
                //  ->where('clinic_id',$request->clinic_id)
                //  ->where('patient_id',$request->patient_id)
                ->get();

        } ///
        elseif ($request->to == 0 && $request->doctor_id != 0 && $request->clinic_id != 0 && $request->patient_id != 0) {


            $PatientReception = PatientReception::whereDate('date', '>=', $request->from)
                //->whereDate('date','<=',$request->to)
                ->whereDate('doctor_id', $request->doctor_id)
                ->where('clinic_id', $request->clinic_id)
                ->where('patient_id', $request->patient_id)
                ->get();

        } elseif ($request->to == 0 && $request->doctor_id == 0 && $request->clinic_id == 0 && $request->patient_id == 0) {


            $PatientReception = PatientReception::whereDate('date', '>=', $request->from)
                //->whereDate('date','<=',$request->to)
                //->whereDate('doctor_id',$request->doctor_id)
                // ->where('clinic_id',$request->clinic_id)
                // ->where('patient_id',$request->patient_id)
                ->get();

        } elseif ($request->to == 0 && $request->doctor_id == 0 && $request->clinic_id != 0 && $request->patient_id == 0) {


            $PatientReception = PatientReception::whereDate('date', '>=', $request->from)
                //->whereDate('date','<=',$request->to)
                // ->whereDate('doctor_id',$request->doctor_id)
                ->where('clinic_id', $request->clinic_id)
                //->where('patient_id',$request->patient_id)
                ->get();

        } elseif ($request->to == 0 && $request->doctor_id == 0 && $request->clinic_id != 0 && $request->patient_id != 0) {


            $PatientReception = PatientReception::whereDate('date', '>=', $request->from)
                //  ->whereDate('date','<=',$request->to)
                // ->whereDate('doctor_id',$request->doctor_id)
                ->where('clinic_id', $request->clinic_id)
                ->where('patient_id', $request->patient_id)
                ->get();

        } elseif ($request->to == 0 && $request->doctor_id == 0 && $request->clinic_id == 0 && $request->patient_id != 0) {


            $PatientReception = PatientReception::whereDate('date', '>=', $request->from)
                //->whereDate('date','<=',$request->to)
                // ->whereDate('doctor_id',$request->doctor_id)
                //->where('clinic_id',$request->clinic_id)
                ->where('patient_id', $request->patient_id)
                ->get();

        } elseif ($request->to == 0 && $request->doctor_id != 0 && $request->clinic_id != 0 && $request->patient_id == 0) {


            $PatientReception = PatientReception::whereDate('date', '>=', $request->from)
                //->whereDate('date','<=',$request->to)
                ->whereDate('doctor_id', $request->doctor_id)
                ->where('clinic_id', $request->clinic_id)
                // ->where('patient_id',$request->patient_id)
                ->get();

        } elseif ($request->to == 0 && $request->doctor_id != 0 && $request->clinic_id == 0 && $request->patient_id != 0) {


            $PatientReception = PatientReception::whereDate('date', '>=', $request->from)
                // ->whereDate('date','<=',$request->to)
                ->whereDate('doctor_id', $request->doctor_id)
                //->where('clinic_id',$request->clinic_id)
                ->where('patient_id', $request->patient_id)
                ->get();

        } elseif ($request->to == 0 && $request->doctor_id != 0 && $request->clinic_id == 0 && $request->patient_id == 0) {


            $PatientReception = PatientReception::whereDate('date', '>=', $request->from)
                //->whereDate('date','<=',$request->to)
                ->whereDate('doctor_id', $request->doctor_id)
                //  ->where('clinic_id',$request->clinic_id)
                //  ->where('patient_id',$request->patient_id)
                ->get();

        }

        return $PatientReception;
    }
}




