<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\BankSteps;
use App\Models\contractingPartyIncomeExpense;
use App\Models\DayBankBalance;
use App\Models\DayTreasuryBalance;
use App\Models\Treasury;
use App\Models\TreasurySteps;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class contractingPartyIncomeExpensesController extends Controller
{

    use GeneralTrait;

    public function show()
    {
        $contractingPartyIncomeExpense = contractingPartyIncomeExpense::where('softDelete', 0)->get();
        return response()->json($contractingPartyIncomeExpense);
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
            if($request->kind == 1){
                $contractingPartyIncomeExpense_id = contractingPartyIncomeExpense::create([

                    'date' => $request->date,
                    'contractingParty_id' => $request->contractingParty_id,
                    'payingKind' => $request->payingKind,
                    'payingKind_id' => $request->payingKind_id,
                    //'pay' => $request->total,
                    'collection' => $request->total,
                    'note' => $request->note,
                ]);
            }else{
                $contractingPartyIncomeExpense_id = contractingPartyIncomeExpense::create([

                    'date' => $request->date,
                    'contractingParty_id' => $request->contractingParty_id,
                    'payingKind' => $request->payingKind,
                    'payingKind_id' => $request->payingKind_id,
                    'pay' => $request->total,
                    //'collection' => $request->total,
                    'note' => $request->note,
                ]);
            }

            if($request->kind == 1){
                $kind='ايراد دكتور'  ;
            }else{
                $kind='مصروف دكتور'  ;

            }
            if ($request->payingKind == 1) {
                TreasurySteps::create([
                    'kind' => $kind,
                    'kind_id' => $contractingPartyIncomeExpense_id->id,
                    'treasury_id' => $request->payingKind_id,
                    // 'pay' => $total,                //مدين --خارج
                    'collection' => $request->total, // داين -- داخل
                    'user_id' => $request->user_id,
                    'contractingParty_id' => $request->contractingParty_id,
                    'note' => $request->note,
                ]);
                DayTreasuryBalance::updateOrCreate([
                    'date' => date('d-m-Y'),
                    'treasury_id' => $request->payingKind], [
                    'balance' =>  $balance + $request->total,
                ]);
            }
            else {
                BankSteps::create([
                    'kind' => $kind,
                    'kind_id' => $contractingPartyIncomeExpense_id->id,
                    'bank_id' => $request->payingKind_id,
                    // 'pay' => $total,                //مدين --خارج
                    'collection' => $request->total, // داين -- داخل
                    'user_id' => $request->user_id,
                    'contractingParty_id' => $request->contractingParty_id,
                    'note' => $request->note,
                ]);
                DayBankBalance::updateOrCreate([
                    'date' => date('d-m-Y'),
                    'bank_id' => $request->payingKind], [
                    'balance' =>  $balance + $request->total,
                ]);
            }
            return $this->returnSuccessMessage('save success', 'storing');          //return token

        } catch (\Exception $ex) {
            return $this->returnError($ex->getCode(), $ex->getMessage());
        }


    }

    public function update(Request $request, $id)
    {
        $contractingPartyIncomeExpense = contractingPartyIncomeExpense::find($id);

        if (!$contractingPartyIncomeExpense) {
            return $this->returnError('001', 'هذا  غير موجد');
        }
        try {
            $store_arr = [];
            foreach ($request->all() as $key => $value) {
                if ($key == '_token') continue;//skip token
                $store_arr[$key] = $value;
            }
            $total = contractingPartyIncomeExpense::where('id', $id)->value('total');
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
            if($request->kind == 1){
                contractingPartyIncomeExpense::where('id',$id)->update([

                    'date' => $request->date,
                    'contractingParty_id' => $request->contractingParty_id,
                    'payingKind' => $request->payingKind,
                    'payingKind_id' => $request->payingKind_id,
                    //'pay' => $request->total,
                    'collection' => $request->total,
                    'note' => $request->note,
                ]);
            }else{
                contractingPartyIncomeExpense::where('id',$id)->update([

                    'date' => $request->date,
                    'contractingParty_id' => $request->contractingParty_id,
                    'payingKind' => $request->payingKind,
                    'payingKind_id' => $request->payingKind_id,
                    'pay' => $request->total,
                    //'collection' => $request->total,
                    'note' => $request->note,
                ]);
            }


            if($request->kind == 1){
                $kind='ايراد دكتور تعديل'  ;
            }else{
                $kind='مصروف دكتور تعديل'  ;

            }
            if ($request->payingKind == 1) {
                TreasurySteps::create([
                    'kind' => $kind,
                    'kind_id' => $id,
                    'treasury_id' => $request->payingKind_id,
                    // 'pay' => $total,                //مدين --خارج
                    'collection' => $request->total, // داين -- داخل
                    'user_id' => $request->user_id,
                    'contractingParty_id' => $request->contractingParty_id,
                    'note' => $request->note,
                ]);
                DayTreasuryBalance::updateOrCreate([
                    'date' => date('d-m-Y'),
                    'treasury_id' => $request->payingKind], [
                    'balance' =>  $balance + $request->total,
                ]);
            }
            else {
                BankSteps::create([
                    'kind' => $kind,
                    'kind_id' => $id,
                    'bank_id' => $request->payingKind_id,
                    // 'pay' => $total,                //مدين --خارج
                    'collection' => $request->total, // داين -- داخل
                    'user_id' => $request->user_id,
                    'contractingParty_id' => $request->contractingParty_id,
                    'note' => $request->note,
                ]);
                DayBankBalance::updateOrCreate([
                    'date' => date('d-m-Y'),
                    'bank_id' => $request->payingKind], [
                    'balance' =>  $balance + $request->total,
                ]);
            }
            $total = contractingPartyIncomeExpense::where('id', $id)->value('total');

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
    function delete($id)
    {
        $total = contractingPartyIncomeExpense::where('id', $id)->value('total');
        $payingKind = contractingPartyIncomeExpense::where('id', $id)->value('payingKind');
        $payingKind_id = contractingPartyIncomeExpense::where('id', $id)->value('payingKind_id');
        $contractingParty_id = contractingPartyIncomeExpense::where('id', $id)->value('contractingParty_id');
        $user_id = contractingPartyIncomeExpense::where('id', $id)->value('user_id');
        $note = contractingPartyIncomeExpense::where('id', $id)->value('note');
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
                'kind_id' => $id,
                'treasury_id' => $payingKind_id,
                'pay' => $total,                //مدين --خارج
                // 'collection' => $request->total, // داين -- داخل
                'user_id' => $user_id,
                'contractingParty_id' => $contractingParty_id,
                'note' => $note,
            ]);
        }
        else {
            BankSteps::create([
                'kind_id' => $id,
                'bank_id' => $payingKind_id,
                'pay' => $total,                //مدين --خارج
                //'collection' => $total, // داين -- داخل
                'user_id' => $user_id,
                'contractingParty_id' => $contractingParty_id,
                'note' => $note,
            ]);
        }
        contractingPartyIncomeExpense::where('id', $id)->update([
            'softDelete' => 1,
        ]);
        return $this->returnSuccessMessage('deleting success', 'delete');          //return token

    }

}




