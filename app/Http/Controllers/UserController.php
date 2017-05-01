<?php

namespace App\Http\Controllers;

use App\BankAccount;
use App\Card;
use App\Consts;
use App\Facades\UserService;
use App\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function getPayPage(){
        return view('user.pay');
    }

    public function getTransferPage(){
        return view('user.transfer');
    }

    public function createPayTransaction(Request $request){
        $params = json_decode($request->input('params'));
        DB::beginTransaction();
        try{
            $bank_account = $params->bank_account;
            $pay_transaction = $params->pay_transaction;
            $bankAccount = UserService::updateBankAccount($bank_account->bank_account_id, $pay_transaction->amount);
            if(empty($bankAccount)) {
                return array("status" => Consts::ERROR, "message" => "Invalid params");
            }

            UserService::createPayTransaction($params->bank_account->card_id, $bankAccount, $pay_transaction);

            DB::commit();
            return array("status" => Consts::SUCCESS, "message" => "create transaction success");
        }catch (Exception $e){
            DB::rollback();
            Log::error($e->getMessage());
            return array("status" => Consts::ERROR, "message" => $e->getMessage());
        }
    }

    public function createTransferTransaction(Request $request){
        $params = json_decode($request->input('params'));
        DB::beginTransaction();
        try{
            $bank_account = $params->bank_account;
            $transferTransaction = $params->transfer_transaction;

            $bankAccount = UserService::updateBankAccount($bank_account->bank_account_id, $transferTransaction->amount);
            if(empty($bankAccount)) {
                return array("status" => Consts::ERROR, "message" => "Invalid params");
            }

            UserService::createTransferTransaction($bankAccount, $transferTransaction);

            DB::commit();
            return array("status" => Consts::SUCCESS, "message" => "create transaction success");
        }catch (Exception $e){
            DB::rollback();
            Log::error($e->getMessage());
            return array("status" => Consts::ERROR, "message" => $e->getMessage());
        }
    }
}
