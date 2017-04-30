<?php
/**
 * Created by PhpStorm.
 * User: hungnguyen
 * Date: 24/04/2017
 * Time: 19:34
 */

namespace App\Http\Controllers\Staff;


use App\Http\Controllers\AccountController as UserAccountController;
use Illuminate\Support\Facades\Auth;

class AccountController extends UserAccountController
{
    protected function guard(){
        return Auth::guard("staff");
    }
}