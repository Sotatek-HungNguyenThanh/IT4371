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
use App\Facades\UserService;
use App\Http\Controllers\Controller;
use App\User;
use App\Utils;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StaffController extends Controller
{
    public function getCreateCustomerPage(){
        return view('staff.create_customer');
    }

    public function createCustomer(Request $request){
        $params =  $request->all();
        DB::beginTransaction();
        try {
            $user = new User();
            $user->name = $params["name"];
            $user->email = $params["email"];
            $user->password = bcrypt("a");
            $user->telephone = $params["telephone"];
            $user->address = $params["address"];
            $user->save();

            $bankAccount = new BankAccount();
            $bankAccount->user_id = $user->id;
            $bankAccount->account_number =  Utils::createBankNumber();
            $bankAccount->balance = $params["balance"];
            $bankAccount->save();


            $card = new Card();
            $card->card_number = Utils::createCardNumber();
            $card->bank_account_id = $bankAccount->id;
            $card->user_id = $user->id;
            $card->save();
            DB::commit();
            $request->session()->flash('alert-success', 'Password change success!');
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

            UserService::createDepositTransaction($bankAccount, $depositTransaction);

            DB::commit();
            return array("status" => Consts::SUCCESS, "message" => "create transaction success");
        }catch (Exception $e){
            DB::rollback();
            Log::error($e->getMessage());
            return array("status" => Consts::ERROR, "message" => $e->getMessage());
        }
    }
}