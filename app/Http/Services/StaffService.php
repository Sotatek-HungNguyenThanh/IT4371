<?php
/**
 * Created by PhpStorm.
 * User: hungnguyen
 * Date: 01/05/2017
 * Time: 21:42
 */

namespace App\Http\Services;


use App\BankAccount;
use App\Card;
use App\Consts;
use App\Transaction;
use App\User;
use App\Utils;
use Carbon\Carbon;

class StaffService
{
    public function createTransferTransaction($transferTransaction){
        $transaction = new Transaction();
        $transaction->type = Consts::TRANSFER;
        $transaction->sender_name = $transferTransaction->receiver_name;
        $transaction->receiver_name = $transferTransaction->receiver_name;

        $bankAccountTo = BankAccount::where('account_number', $transferTransaction->account_number)->first();

        if(empty($bankAccountTo)){
            $transaction->bank_account_number = $transferTransaction->account_number;
        }else{
            $transaction->bank_account_id =  $bankAccountTo->id;
            $transaction->bank_account_number = $transferTransaction->account_number;
        }
        $transaction->amount = $transferTransaction->amount;
        $transaction->date = Carbon::parse($transferTransaction->date);
        if(isset($transferTransaction->content))
            $transaction->content = $transferTransaction->content;
        $transaction->save();
    }

    public function createUser($params){
        $user = new User();
        $user->name = $params["name"];
        $user->email = $params["email"];
        $user->password = bcrypt("a");
        $user->telephone = $params["telephone"];
        $user->address = $params["address"];
        $user->save();
        return $user;
    }

    public function createBankAccount($user, $params){
        $bankAccount = new BankAccount();
        $bankAccount->user_id = $user->id;
        $bankAccount->account_number =  Utils::createBankNumber();
        $bankAccount->balance = $params["balance"];
        $bankAccount->save();
        return $bankAccount;
    }

    public function createCard($bankAccount, $user){
        $card = new Card();
        $card->card_number = Utils::createCardNumber();
        $card->bank_account_id = $bankAccount->id;
        $card->user_id = $user->id;
        $card->save();
        return $card;
    }
}