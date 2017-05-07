<?php

namespace App\Http\Controllers;

use App\BankAccount;
use App\Card;
use App\Consts;
use App\Facades\RedisService;
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
    public function showHomePage(){
        return view('user.update_info');
    }

    public function getPayPage(){
        return view('user.pay');
    }

    public function getTransferPage(){
        return view('user.transfer');
    }

    public function getHistoryPage(){
        return view('user.history');
    }

    public function createPayTransaction(Request $request){
        $params = json_decode($request->input('params'));
        DB::beginTransaction();
        try{
            $bank_account = $params->bank_account;
            $pay_transaction = $params->pay_transaction;

            if($bank_account->balance < $pay_transaction->amount){
                DB::rollback();
                return array("status" => Consts::ERROR, "message" => "Số dư không đủ");
            }
            $bankAccount = UserService::withdrawBankAccount($bank_account->bank_account_id, $pay_transaction->amount);
            if(empty($bankAccount)) {
                DB::rollback();
                return array("status" => Consts::ERROR, "message" => "Số tài khoản không tồn tại");
            }

            $transaction = UserService::createPayTransaction($params->bank_account->card_id, $bankAccount, $pay_transaction);
            RedisService::publishTransaction($transaction->id);
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

            if($bank_account->balance < $transferTransaction->amount){
                return array("status" => Consts::ERROR, "message" => "Số dư không đủ");
            }
            $bankAccount = UserService::withdrawBankAccount($bank_account->bank_account_id, $transferTransaction->amount);
            if(empty($bankAccount)) {
                DB::rollback();
                return array("status" => Consts::ERROR, "message" => "Số tài khoản không tồn tại");
            }

            $transaction = UserService::createTransferTransaction($bankAccount, $transferTransaction);
            RedisService::publishTransaction($transaction->id);
            DB::commit();
            return array("status" => Consts::SUCCESS, "message" => "create transaction success");
        }catch (Exception $e){
            DB::rollback();
            Log::error($e->getMessage());
            return array("status" => Consts::ERROR, "message" => $e->getMessage());
        }
    }

    protected function guard(){
        return Auth::guard();
    }

    public function getHistoryTransaction(){
        return UserService::getHistoryTransaction();
    }

    public function getAddMoneyPage(){
        return view('user.add_money');
    }

    public function depositMoneyAccount(Request $request){
        $params = json_decode($request->input('params'));
        DB::beginTransaction();
        try{
            $depositTransaction = $params->deposit_transaction;

            $data = Card::join('bank_accounts', 'bank_accounts.id', '=', 'cards.bank_account_id')
                ->join('users', 'users.id', '=', 'cards.user_id')
                ->select('bank_accounts.id as bank_account_id',
                    'bank_accounts.account_number as bank_account_number', 'bank_accounts.balance')
                ->where('cards.user_id', $this->guard()->user()->id)
                ->first();

            $bankAccount = UserService::depositBankAccount($data->bank_account_id, $depositTransaction->amount);

            $transaction = new Transaction();
            $transaction->type = Consts::DEPOSIT;
            $transaction->sender_id = $this->guard()->user()->id;
            $transaction->sender_name = $this->guard()->user()->name;
            $transaction->bank_account_id =  $bankAccount->id;
            $transaction->bank_account_number = $bankAccount->account_number;
            $transaction->amount = $depositTransaction->amount;
            $transaction->date = Carbon::parse($depositTransaction->date);
            if(isset($depositTransaction->content))
                $transaction->content = $depositTransaction->content;
            $transaction->save();

            RedisService::publishTransaction($transaction->id);
            DB::commit();
            return array("status" => Consts::SUCCESS, "message" => "create transaction success");
        }catch (Exception $e){
            DB::rollback();
            Log::error($e->getMessage());
            return array("status" => Consts::ERROR, "message" => $e->getMessage());
        }
    }

    public function getUserInfo(){
        return Auth::guard()->user();
    }
}
