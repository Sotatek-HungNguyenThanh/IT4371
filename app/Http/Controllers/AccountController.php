<?php
namespace App\Http\Controllers;
/**
 * Created by PhpStorm.
 * User: hungnguyen
 * Date: 24/04/2017
 * Time: 19:34
 */

namespace App\Http\Controllers;


use App\Foundation\AccountUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Exception;

class AccountController extends Controller
{
    use AccountUser;

    public function getManagePasswordPage(){
        return view('user.manage_password');
    }

    public function getUpdateInfoPage(){
        return view('user.update_info');
    }

    public function getBankAccountInfo(){
        $user = $this->guard()->user();
        $bankAccountInfo = User::join('bank_accounts', 'bank_accounts.user_id', 'users.id')
            ->where('users.id', $user->id)
            ->select('bank_accounts.account_number', 'bank_accounts.balance')
            ->first();
        return $bankAccountInfo;
    }
}