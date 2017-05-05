<?php
/**
 * Created by PhpStorm.
 * User: hungnguyen
 * Date: 02/05/2017
 * Time: 10:07
 */

namespace App\Http\Services;
use App\BankAccount;
use App\Consts;
use App\Transaction;
use LRedis;

class RedisService
{
    public function publish($channel, $data){
        LRedis::publish($channel, json_encode($data));
    }

    public function publishDeposit($transactionID){
        $notifications = $this->getInfoNotification($transactionID);
        $this->publish(Consts::DEPOSIT, $notifications);
    }

    public function publishWithdraw($transactionID){
        $notifications = $this->getInfoNotification($transactionID);
        $this->publish(Consts::WITHDRAW, $notifications);
    }

    public function publishTransfer($transactionID){
        $notifications = $this->getInfoNotification($transactionID);
        $this->publish(Consts::TRANSFER, $notifications);
    }

    public function publishUpdateAccount($transactionID){
        $notifications = $this->getInfoNotification($transactionID);
        $this->publish(Consts::UPDATE, $notifications);
    }

    public function publishBlockAccount($user){
        $this->publish("block_account", $user);
    }

    protected function getInfoNotification($transactionID){
        return Transaction::leftJoin("bank_accounts as bk1", "bk1.id", "transactions.bank_account_id")
            ->leftJoin("bank_accounts as bk2", "bk2.account_number", "transactions.bank_account_number")
            ->leftJoin("users", "users.id", "transactions.sender_id")
            ->select("bk1.account_number", "transactions.sender_name", "users.name",
                "transactions.receiver_name", "transactions.amount",
                "transactions.content", "transactions.date", "bk1.balance")
            ->where('transactions.id', $transactionID)
            ->get();
    }
}