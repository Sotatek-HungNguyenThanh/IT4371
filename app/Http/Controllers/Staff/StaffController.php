<?php
/**
 * Created by PhpStorm.
 * User: hungnguyen
 * Date: 01/05/2017
 * Time: 10:20
 */

namespace App\Http\Controllers\Staff;


use App\Bank_Account;
use App\BankAccount;
use App\Card;
use App\Consts;
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
}