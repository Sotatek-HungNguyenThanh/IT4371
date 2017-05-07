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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StaffController extends Controller
{
    public function getCreateCustomerPage()
    {
        return view('staff.create_customer');
    }

    public function getTransferPage()
    {
        return view('staff.transfer');
    }

    public function createCustomer(Request $request)
    {
        $params = $request->all();
        DB::beginTransaction();
        try {
            $user = StaffService::createUser($params);
            $bankAccount = StaffService::createBankAccount($user, $params);
            StaffService::createCard($bankAccount, $user);

            DB::commit();
            $request->session()->flash('alert-success', 'Create Customer Success!');
            return redirect()->back();
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());

            $errors = [
                'alert-error' => 'Account existed!'
            ];
            return redirect()->back()->withErrors($errors);
        }
    }

    public function getAddMoneyPage()
    {
        return view('staff.add_money');
    }

    public function depositMoneyAccount(Request $request)
    {
        $params = json_decode($request->input('params'));
        DB::beginTransaction();
        try {
            $depositTransaction = $params->deposit_transaction;

            $bankAccount = BankAccount::where("account_number", $depositTransaction->account_number)->first();

            if (empty($bankAccount)) {
                return array("status" => Consts::ERROR, "message" => "Số tài khoản không tồn tại");
            }
            $bankAccount = UserService::depositBankAccount($bankAccount->id, $depositTransaction->amount);

            $transaction = UserService::createDepositTransaction($bankAccount, $depositTransaction);
            RedisService::publishTransaction($transaction->id);
            DB::commit();
            return array("status" => Consts::SUCCESS, "message" => "create transaction success");
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            return array("status" => Consts::ERROR, "message" => $e->getMessage());
        }
    }

    public function createTransferTransaction(Request $request)
    {
        $params = json_decode($request->input('params'));
        DB::beginTransaction();
        try {
            $_transaction = new Transaction();
            $transferTransaction = $params->transfer_transaction;
            if(isset($transferTransaction->account_number_from)) {
                $bankAccountFrom = BankAccount::where('account_number',
                    $transferTransaction->account_number_from)->first();
                if (empty($bankAccountFrom)) {
                    DB::rollback();
                    return array("status" => Consts::ERROR, "message" => "Tài khoản nguồn không tồn tại");
                }

                if ($bankAccountFrom->balance < $transferTransaction->amount) {
                    DB::rollback();
                    return array("status" => Consts::ERROR, "message" => "Số dư trong tài khoản nguồn không đủ");
                }
                $bankAccountFrom->balance = $bankAccountFrom->balance - $transferTransaction->amount;
                $bankAccountFrom->save();

                $_transaction->type = Consts::TRANSFER;
                $_transaction->sender_name = $transferTransaction->receiver_name;
                $_transaction->receiver_name = $transferTransaction->receiver_name;
                $_transaction->bank_account_id = $bankAccountFrom->id;
                $_transaction->bank_account_number = $transferTransaction->account_number;
                $_transaction->amount = $transferTransaction->amount;
                $_transaction->date = Carbon::parse($transferTransaction->date);
                if (isset($transferTransaction->content))
                    $_transaction->content = $transferTransaction->content;
                $_transaction->save();
            }

            $bankAccountTo = BankAccount::where('account_number', $transferTransaction->account_number)->first();
            if (empty($bankAccountTo)) {
                DB::rollback();
                return array("status" => Consts::ERROR, "message" => "Tài khoản đích không tồn tại");
            }


            $transaction = new Transaction();
            $transaction->type = Consts::TRANSFER;
            $transaction->sender_name = $transferTransaction->receiver_name;
            $transaction->receiver_name = $transferTransaction->receiver_name;
            if (empty($bankAccountTo)) {
                $transaction->bank_account_number = $transferTransaction->account_number;
            } else {
                $transaction->bank_account_id = $bankAccountTo->id;
                $transaction->bank_account_number = $transferTransaction->account_number;
            }
            $transaction->amount = $transferTransaction->amount;
            $transaction->date = Carbon::parse($transferTransaction->date);
            if (isset($transferTransaction->content))
                $transaction->content = $transferTransaction->content;
            $transaction->save();
            $bankAccountTo->balance = $bankAccountTo->balance + $transferTransaction->amount;
            $bankAccountTo->save();
            RedisService::publishTransaction($transaction->id);
            if(isset($_transaction->id)) {
                RedisService::publishTransaction($_transaction->id);
            }
            DB::commit();
            return array("status" => Consts::SUCCESS, "message" => "create transaction success");
        }catch (Exception $e){
            DB::rollback();
            Log::error($e->getMessage());
            return array("status" => Consts::ERROR, "message" => $e->getMessage());
        }
}

public
function getAddOtherCustomerPage()
{
    return view('staff.add_other_bank_account');
}

public
function addOtherCustomer(Request $request)
{
    $params = $request->all();
    DB::beginTransaction();
    try {

        $bankAccount = BankAccount::where('account_number', $params["account_number"])->first();
        if (empty($bankAccount)) {
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
    } catch (Exception $e) {
        DB::rollback();
        Log::error($e->getMessage());

        $errors = [
            'alert-error' => 'Account existed!'
        ];
        return redirect()->back()->withErrors($errors);
    }
}

public
function getListUserPage()
{
    $users = User::get();
    return view('staff.list_user')->with("users", $users);
}

public
function updateStatusUser($id)
{
    $user = User::findOrFail($id);
    $user->status = $user->status == "active" ? "inactive" : "active";
    $user->save();
    RedisService::publishBlockAccountUser($user);
    return redirect()->back();
}

public
function getUserInfo()
{
    return Auth::guard("staff")->user();
}
}