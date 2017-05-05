<?php
/**
 * Created by PhpStorm.
 * User: hungnguyen
 * Date: 01/05/2017
 * Time: 10:20
 */

namespace App\Http\Controllers\Staff;

use App\BankAccount;
use App\Card;
use App\Consts;
use App\Facades\RedisService;
use App\Facades\StaffService;
use App\Facades\UserService;
use App\Http\Controllers\Controller;
use App\Transaction;
use App\User;
use App\Utils;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StaffController extends Controller
{
    public function getCreateCustomerPage(){
        return view('staff.create_customer');
    }

    public function getTransferPage(){
        return view('staff.transfer');
    }

    public function createCustomer(Request $request){
        $params =  $request->all();
        DB::beginTransaction();
        try {
            $user = StaffService::createUser($params);
            $bankAccount = StaffService::createBankAccount($user, $params);
            StaffService::createCard($bankAccount, $user);

            DB::commit();
            $request->session()->flash('alert-success', 'Create Customer Success!');
            return redirect()->back();
        }catch (Exception $e){
            DB::rollback();
            Log::error($e->getMessage());

            $errors = [
                'alert-error' => 'Account existed!'
            ];
            return redirect()->back()->withErrors($errors);
        }
    }

    public function getAddMoneyPage(){
        return view('staff.add_money');
    }

    public function depositMoneyAccount(Request $request){
        $params = json_decode($request->input('params'));
        DB::beginTransaction();
        try{
            $depositTransaction = $params->deposit_transaction;

            $bankAccount = BankAccount::where("account_number", $depositTransaction->account_number)->firstOrFail();

            if(empty($bankAccount)) {
                return array("status" => Consts::ERROR, "message" => "Invalid params");
            }
            $bankAccount = UserService::depositBankAccount($bankAccount->id, $depositTransaction->amount);

            $transaction = UserService::createDepositTransaction($bankAccount, $depositTransaction);
            RedisService::publishUpdateAccount($transaction->id);
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
            $transferTransaction = $params->transfer_transaction;

            StaffService::createTransferTransaction($transferTransaction);

            DB::commit();
            return array("status" => Consts::SUCCESS, "message" => "create transaction success");
        }catch (Exception $e){
            DB::rollback();
            Log::error($e->getMessage());
            return array("status" => Consts::ERROR, "message" => $e->getMessage());
        }
    }

    public function getAddOtherCustomerPage(){
        return view('staff.add_other_bank_account');
    }

    public function addOtherCustomer(Request $request){
        $params =  $request->all();
        DB::beginTransaction();
        try {

            $bankAccount =  BankAccount::where('account_number', $params["account_number"])->first();
            if(empty($bankAccount)){
                $errors = [
                    'alert-error' => 'Bank Account Number not exist!'
                ];
                return redirect()->back()->withErrors($errors);
            }
            $user = StaffService::createUser($params);
            StaffService::createCard($bankAccount, $user);

            DB::commit();
            $request->session()->flash('alert-success', 'Create Customer Success!');
            return redirect()->back();
        }catch (Exception $e){
            DB::rollback();
            Log::error($e->getMessage());

            $errors = [
                'alert-error' => 'Account existed!'
            ];
            return redirect()->back()->withErrors($errors);
        }
    }

    public function getListUserPage(){
        $users = User::get();
        return view('staff.list_user')->with("users", $users);
    }

    public function updateStatusUser($id){
        $user = User::findOrFail($id);
        $user->status =  $user->status == "active" ? "inactive" : "active";
        $user->save();
        RedisService::publishBlockAccount($user);
        return redirect()->back();
    }
}