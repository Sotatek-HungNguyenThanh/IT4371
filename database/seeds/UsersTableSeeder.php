<?php

use App\Card;
use App\User;
use App\Utils;
use Illuminate\Database\Seeder;
use App\BankAccount;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();

        $user = new User();
        $user->name = "User";
        $user->email = "user1@gmail.com";
        $user->password = bcrypt("a");
        $user->save();

        $bankAccount = new BankAccount();
        $bankAccount->user_id = $user->id;
        $bankAccount->account_number =  Utils::createBankNumber();
        $bankAccount->balance = "10000";
        $bankAccount->save();


        $card = new Card();
        $card->card_number = Utils::createCardNumber();
        $card->bank_account_id = $bankAccount->id;
        $card->user_id = $user->id;
        $card->save();
    }
}
