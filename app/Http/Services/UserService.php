<?php

namespace App\Http\Services;

use App\BankAccount;
use App\Card;
use App\Consts;
use App\Transaction;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class UserService
{
    public function getBankAccountInfo($user){
        $card = Card::where("user_id", $user->id)->first();

        $bankAccountInfo = BankAccount::join('cards', 'bank_accounts.id', '=', 'cards.bank_account_id')
            ->where('bank_accounts.id', $card->bank_account_id)
            ->select("cards.id as card_id", "cards.user_id", "cards.card_number" ,
                'bank_accounts.id as bank_account_id', 'bank_accounts.account_number',
                'bank_accounts.balance')
            ->first();
        return $bankAccountInfo;
    }

    public function withdrawBankAccount($bankAccountID, $amount){
        $bankAccount = BankAccount::findOrFail($bankAccountID);
        if($amount > $bankAccount->balance){
            return null;
        }
        $bankAccount->balance =  $bankAccount->balance - $amount;
        $bankAccount->save();
        return $bankAccount;
    }

    public function createPayTransaction($cardID, $bankAccount, $payTransaction){
        $transaction = new Transaction();
        $transaction->type = Consts::WITHDRAW;
        $transaction->sender_id = $this->guard()->user()->id;
        $transaction->card_id = $cardID;
        $transaction->bank_account_id =  $bankAccount->id;
        $transaction->amount = $payTransaction->amount;
        $transaction->date = Carbon::parse($payTransaction->date);
        if(isset($payTransaction->content))
            $transaction->content = $payTransaction->content;
        $transaction->save();
        return $transaction;
    }

    public function createTransferTransaction($bankAccount, $transferTransaction){
        $transaction = new Transaction();
        $transaction->type = Consts::TRANSFER;
        $transaction->sender_id = $this->guard()->user()->id;
        $transaction->receiver_name = $transferTransaction->receiver_name;

        $bankAccountID = BankAccount::select('id')->where('account_number', $transferTransaction->account_number)->first();
        if(isset($bankAccountID)){
            $transaction->bank_account_id =  $bankAccount->id;
        }else{
            $transaction->bank_account_number = $transferTransaction->account_number;
        }
        $transaction->amount = $transferTransaction->amount;
        $transaction->date = Carbon::parse($transferTransaction->date);
        if(isset($transferTransaction->content))
            $transaction->content = $transferTransaction->content;
        $transaction->save();
        return $transaction;
    }

    protected function guard(){
        return Auth::guard();
    }

    public function getHistoryTransaction(){
        $userID = $this->guard()->user()->id;
        $cardInfo =  Card::where('user_id', $userID)->first();

        $historyTransactions =Transaction::leftJoin('users as sender', 'sender.id', 'transactions.sender_id')
            ->leftJoin('cards', 'cards.id', 'transactions.card_id')
            ->leftJoin('bank_accounts', 'bank_accounts.id', 'transactions.bank_account_id')
            ->select('transactions.id as transaction_id', 'transactions.type',
                'transactions.sender_name', 'transactions.sender_name', 'transactions.sender_id',
                'receiver_name', 'cards.card_number', 'transactions.bank_account_number',
                'bank_accounts.account_number', 'transactions.amount', 'transactions.date', 'transactions.content')
            ->where('sender_id', $userID)
            ->orWhere('transactions.bank_account_id', $cardInfo["bank_account_id"])
            ->orderBy('transactions.date', 'asc')
            ->orderBy('transactions.created_at', 'asc')
            ->get();
        return $historyTransactions;
    }

    public function createDepositTransaction($bankAccount, $depositTransaction){
        $transaction = new Transaction();
        $transaction->type = Consts::DEPOSIT;
        $transaction->sender_name = $depositTransaction->sender_name;
        $transaction->bank_account_id =  $bankAccount->id;
        $transaction->bank_account_number = $bankAccount->account_number;
        $transaction->amount = $depositTransaction->amount;
        $transaction->date = Carbon::parse($depositTransaction->date);
        if(isset($depositTransaction->content))
            $transaction->content = $depositTransaction->content;
        $transaction->save();
        return $transaction;
    }

    public function depositBankAccount($bankAccountID, $amount){
        $bankAccount = BankAccount::find($bankAccountID);
        $bankAccount->balance =  $bankAccount->balance + $amount;
        $bankAccount->save();
        return $bankAccount;
    }
}